def process_slave_items(raw_items):
    # removes unimportant variables, flattens variation products
    items = []
    for item in raw_items:
        items.append({
            'id': item['id'],
            'sku': item['sku'],
            'stock_quantity': item['stock_quantity']
        })
        for var_item in item['variations']:
            items.append({
                'id': item['id'],
                'sku': var_item['sku'],
                'variation_id': var_item['id'],
                'stock_quantity': var_item['stock_quantity']
            })
    return items


def process_master_items(raw_items):
    # Transforms sql query response to json
    items = {}
    return items


def process_order_items(raw_orders):
    # removes unimportant variables, returns aggregated items from orders
    aggregated_items = {}
    for order in raw_orders:
        for item in order['line_items']:
            quantity = item['stock_quantity']
            if aggregated_items.get(item['id']):
                quantity += aggregated_items.get(item['id'])['stock_quantity']
            aggregated_items[item['id']] = {
                'id': item['id'],
                'sku': item['sku'],
                'stock_quantity': quantity
            }
    return aggregated_items.values()


def calculate_stock(item, orders):
    stock = item['stock_quantity']
    for ord_item in orders:
        if ord_item['id'] == item['id']:
            stock -= ord_item['stock_quantity']
    return stock


def get_relevant_items(slave_items, master_items):
    # returns slave_items that are in master_items
    pass


def get_relevant_orders(slave_orders, master_items):
    # returns slave_order items that are in master_items
    pass
