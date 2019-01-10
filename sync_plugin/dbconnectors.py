from syncutils import RestException, backoff, transaction
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
        response = self.wcapi.get("products?per_page=1")
        if not response.ok:
            logger.debug('Error: {}'.format(response.json()))
            raise Exception('Wordpress connection error')

    @backoff
    def get_orders(self):
        logger.debug('[SLAVE] Fetching not processed orders')
        response = self.wcapi.get("orders?per_page=100")
        if not response.ok:
            raise RestException(response.json())
        orders = response.json()
        # we are interested only in unresolved orders
        return [obj for obj in orders if obj['status'] == 'processing']

    @backoff
    def get_variation(self, id, variation):
        text = '[SLAVE] Fetching variation id={} for product: id={}'
        logger.debug(text.format(variation, id))
        url = "products/{}/variations/{}".format(id, variation)
        response = self.wcapi.get(url)
        if not response.ok:
            raise RestException(response.json())
        return response.json()

    @backoff
    def get_items(self):
        logger.debug('[SLAVE] Fetching all products')
        response = self.wcapi.get("products?per_page=100")
        if not response.ok:
            raise RestException(response.json())
        products = response.json()
        for product in products:
            # products may include ids of its variations, thus we have to
            # download them via separate rest request...
            parsed_variations = []
            for variation in product['variations']:
                var = self.get_variation(product['id'], variation)
                parsed_variations.append(var)
            product['variations'] = parsed_variations
        return products

    @backoff
    def update_order_status(self, order, status):
        logger.debug('[SLAVE] Updating order: id={}'.format(order['id']))
        data = {"status": status}
        response = self.wcapi.put("orders/{}".format(order['id']), data)
        if not response.ok:
            raise RestException(response.json())
        return response.json()

    @backoff
    def update_item_stock(self, item, stock):
        if item.get('variation_id', False):
            return self.update_item_variation_stock(item, stock)
        logger.debug('[SLAVE] Updating product: {} stock: {}'.format(
            item['id'], stock))
        data = {"stock_quantity": stock}
        response = self.wcapi.put("products/{}".format(item['id']), data)
        if not response.ok:
            raise RestException(response.json())
        return response.json()

    @backoff
    def update_item_variation_stock(self, item, stock):
        text = '[SLAVE] Updating product_variation: id={}/{} stock: {}'
        logger.debug(text.format(item['id'], item['variation_id'], stock))
        data = {"stock_quantity": stock}
        url = "products/{}/variations/{}".format(
            item['id'], item['variation_id'])
        response = self.wcapi.put(url, data)
        if not response.ok:
            raise RestException(response.json())
        return response.json()


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
        logger.debug('[MASTER] Fetching all products')
        with transaction(self.conn, logger) as cursor:
            query = "SELECT * FROM product"
            cursor.execute(query)
            return cursor.fetchall()

    def update_item_stock(self, id, stock):
        logger.debug('[MASTER] Updating product: sku={}'.format(id))
        with transaction(self.conn, logger) as cursor:
            query = "UPDATE product SET Stock=%(stock)s WHERE productid=%(id)s"
            cursor.execute(query, (stock, id))
            return cursor.fetchall()
