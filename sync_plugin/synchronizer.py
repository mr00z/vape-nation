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

    def run(self):
        logger.debug('#1/5 Fetching items...')
        raw_master_items = self.master.get_items()
        raw_slave_items = self.slave.get_items()
        raw_slave_orders = self.slave.get_orders()
        return False

        logger.debug('#2/5 Processing items...')
        master_items = fun.process_master_items(raw_master_items)
        slave_items = fun.process_slave_items(raw_slave_items)
        slave_items = fun.get_relevant_items(slave_items, master_items)

        logger.debug('#3/5 Processing orders...')
        slave_orders = fun.process_order_items(raw_slave_orders)
        slave_orders = fun.get_relevant_orders(slave_orders, master_items)

        # remove unused variables to free some memory
        gc.collect()

        logger.debug('#4/5 Updating items...')
        for item in master_items:
            new_stock = fun.calculate_stock(item, slave_orders)
            s_item = [i for i in slave_items if i['sku'] == item['id']]
            self.slave.update_item_stock(s_item['sku'], new_stock)
            self.master.update_item_stock(item['id'], new_stock)

        logger.debug('#5/5 Updating orders...')
        order_id_set = set([order['id'] for order in slave_orders])
        for id in order_id_set:
            self.slave.update_order_status(id, 'completed')


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
