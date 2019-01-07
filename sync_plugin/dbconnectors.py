from woocommerce import API

import logging
import psycopg2


logger = logging.getLogger('synchronizer')


class SlaveDB:
    def __init__(self, key, password, address):
        logger.debug('Connecting to Wordpress...')
        self.wcapi = API(
            url=address,
            consumer_key=key,
            consumer_secret=password,
            wp_api=True,
            version="wc/v3"
        )
        test = self.wcapi.get("products?per_page=1")
        if not test.ok:
            logger.debug('Error: {}'.format(test.json()))
            raise Exception('Connection error')

    def get_orders(self):
        logger.debug('Fetching not processed orders')
        orders = self.wcapi.get("orders?per_page=100").json()
        return [obj for obj in orders if obj['status'] == 'processing']

    def get_items(self):
        logger.debug('Fetching all products')
        return self.wcapi.get("products?per_page=100").json()

    def update_order_status(self, order_id, status):
        logger.debug('Updating order: {}'.format(order_id))
        data = {"status": status}  # should be completed
        return self.wcapi.put("orders/{}".format(order_id), data)

    def update_item_stock(self, item_id, stock):
        logger.debug('Updating product: {} stock: {}'.format(item_id, stock))
        data = {"stock_quantity": stock}
        return self.wcapi.put("products/{}".format(item_id), data)

    def update_item_variation_stock(self, item_id, item_variation_id, stock):
        logger.debug('Updating item/variation: {}/{} stock: {}'.format(
            item_id, item_variation_id, stock))
        data = {"stock_quantity": stock}
        path = "products/{}/variations/{}".format(item_id, item_variation_id)
        return self.wcapi.put(path, data)


class MasterDB:
    def __init__(self, host, database, user, password):
        logger.debug('Connecting to postgres...')
        self.conn = psycopg2.connect(
            host=host,
            database=database,
            user=user,
            password=password
        )

    def __del__(self):
        if self.conn:
            logger.debug('Closing connection to postgres')
            self.conn.close()

    def get_items(self):
        logger.debug('Fetching items')
        with self.conn.cursor() as cursor:
            query = ""
            cursor.execute(query)
            return cursor.fetchall()

    def update_items(self):
        logger.debug('Updating items')
        with self.conn.cursor() as cursor:
            query = ""
            cursor.execute(query)
            return cursor.fetchall()
