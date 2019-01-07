from configparser import ConfigParser
import logging
import argparse

from dbconnectors import SlaveDB, MasterDB


logger = logging.getLogger('synchronizer')


def parse_args():
    parser = argparse.ArgumentParser(description='Synchronization tool')
    parser.add_argument('--slave_config', '-S', required=True,
                        help='PATH: credentials file for wordpress')
    parser.add_argument('--master_config', '-M', required=True,
                        help='PATH: credentials file for postgres')
    parser.add_argument('--debug', '-D', action='store_false',
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
        logger.debug('Running synchronizer...')


def load_configs(slave_config, master_config):
    logger.debug('Parsing master configs...')
    master_parser = ConfigParser()
    master_parser.read(master_config)
    logger.debug('Parsing slave configs...')
    slave_parser = ConfigParser()
    slave_parser.read(slave_config)
    return master_parser['CREDS'], slave_parser['CREDS']


def main(slave_config, master_config):
    logger.debug('Starting synchronizer...')
    slave_config, master_config = load_configs(slave_config, master_config)
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
    logger.debug('Synchronization complete!')


if __name__ == "__main__":
    args = parse_args()
    setup_logger(args.debug)
    main(args.slave_config, args.master_config)
