from configparser import ConfigParser
import gc
import logging
import datetime
import argparse

import preprocessing as fun
from dbconnectors import SlaveDB, MasterDB


logging.basicConfig(
    format="%(levelname)s - %(name)s: %(message)s",
    level=logging.INFO,
    handlers=[logging.StreamHandler()]
)
logger = logging.getLogger('synchronizer')


def parse_args():
    parser = argparse.ArgumentParser(description='Synchronization tool')
    parser.add_argument('--slave_config', '-S', required=True,
                        help='PATH: credentials file for wordpress')
    parser.add_argument('--master_config', '-M', required=True,
                        help='PATH: credentials file for postgres')
    parser.add_argument('--debug', '-D', action='store_true',
                        help='FLAG: print debug messages')
    args = parser.parse_args()
    return args


def setup_logger(debug):
    if debug:
        logger.setLevel(logging.DEBUG)
    else:
        logger.setLevel(logging.INFO)


class Synchronizer:
    def __init__(self, master, slave):
        self.master = master
        self.slave = slave

    def fetch_items(self):
        self.raw_master_items = self.master.get_items()
        self.raw_slave_items = self.slave.get_items()
        self.raw_slave_orders = self.slave.get_orders()

    def process_items(self):
        self.master_items = fun.process_master_items(self.raw_master_items)
        self.slave_items = fun.process_slave_items(self.raw_slave_items)
        self.slave_items = fun.get_relevant_items(
            self.slave_items, self.master_items)

    def process_orders(self):
        self.slave_orders = fun.process_order_items(self.raw_slave_orders)
        self.slave_orders = fun.get_relevant_orders(
            self.slave_orders, self.slave_items)
        self.order_ids = set([p['order_id'] for p in self.slave_orders])

    def update_items(self):
        for item in self.slave_items:
            m_item = [i for i in self.master_items
                      if i['sku'] == item['sku']][0]
            new_stock = fun.calculate_stock(m_item, self.slave_orders)
            self.slave.update_item_stock(item, new_stock)
            self.master.update_item_stock(m_item, new_stock)

    def update_orders(self):
        for id in self.order_ids:
            self.slave.update_order_status(id, 'completed')

    def run(self):
        logger.debug('#1/5 Fetching items...')
        self.fetch_items()
        if not self.raw_master_items:
            logger.info('No items in postgres!')
            return None
        if not self.raw_slave_items:
            logger.info('No items in wordpress!')
            return None
        if not self.raw_slave_orders:
            logger.info('No new orders!')
            return None

        logger.debug('#2/5 Processing items...')
        self.process_items()
        if not self.slave_items:
            logger.info('No products in wordpress match with postgres!')
            return None

        logger.debug('#3/5 Processing orders...')
        self.process_orders()
        if not self.slave_orders:
            logger.info('No new orders!')
            return None

        gc.collect()  # remove unused variables to free some memory
        logger.debug('#4/5 Updating items...')
        self.update_items()
        logger.debug('#5/5 Updating orders...')
        self.update_orders()


def load_configs(slave_config, master_config):
    master_parser = ConfigParser()
    master_parser.read(master_config)
    logger.debug('Parsed master configs')
    slave_parser = ConfigParser()
    slave_parser.read(slave_config)
    logger.debug('Parsed slave configs')
    return master_parser['CREDS'], slave_parser['CREDS']


def main(slave_config, master_config):
    start_time = datetime.datetime.now()
    logger.debug('Starting synchronizer')
    master_config, slave_config = load_configs(slave_config, master_config)
    master = MasterDB(
        host=master_config['host'],
        database=master_config['database'],
        user=master_config['user'],
        password=master_config['password']
    )
    slave = SlaveDB(
        key=slave_config['key'],
        password=slave_config['password'],
        address=slave_config['address']
    )
    Synchronizer(master, slave).run()
    del master
    end_time = datetime.datetime.now()
    logger.debug('Synchronization complete!')
    delta = (end_time - start_time).total_seconds()
    logger.debug('Duration: {}s'.format(delta))


if __name__ == "__main__":
    args = parse_args()
    setup_logger(args.debug)
    main(args.slave_config, args.master_config)
