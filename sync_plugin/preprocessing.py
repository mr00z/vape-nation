class DataProcessor:
    def __init__(self):
        pass

    @staticmethod
    def process_slave_items(raw_items):
        items = []
        for item in raw_items:
            items.append({
                'id': item['id'],
                'sku': item['sku'],
                'stock_quantity': item['stock_quantity']
            })
            for var_item in item['variations']:
                items.append({
                    'id': var_item['id'],
                    'sku': var_item['sku'],
                    'stock_quantity': var_item['stock_quantity']
                })
        return items

    @staticmethod
    def process_master_items(raw_items):
        pass

    @staticmethod
    def process_order_items(raw_orders):
        items = []
        for order in raw_orders:
            for item in order['line_items']:
                items.append({
                    'id': item['id'],
                    'sku': item['sku'],
                    'stock_quantity': item['stock_quantity']
                })
        return items

    @staticmethod
    def calculate_stock(item, orders):
        stock = item['stock_quantity']
        for ord_item in orders:
            if ord_item['id'] == item['id']:
                stock -= ord_item['stock_quantity']
        return stock
