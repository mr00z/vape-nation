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
    items = []
    for item in raw_items:
        items.append({
            'sku': str(item[0]),
            # 'name': item[1],
            'stock_quantity': item[2],
            # 'price': item[3],
            'variation_sku': str(item[4])
        })
    return items


def process_order_items(raw_orders):
    # removes unimportant variables, returns aggregated items from orders
    aggregated_items = {}
    for order in raw_orders:
        for item in order['line_items']:
            quantity = item['quantity']
            if aggregated_items.get(item['sku']):
                quantity += aggregated_items.get(item['sku'])['stock_quantity']
            aggregated_items[item['sku']] = {
                'order_id': order['id'],
                'id': item['id'],
                'sku': item['sku'],
                'stock_quantity': quantity
            }
    return list(aggregated_items.values())


def calculate_stock(item, orders):
    stock = item['stock_quantity']
    for ord_item in orders:
        if ord_item['sku'] == item['sku']:
            stock -= ord_item['stock_quantity']
    return stock


def get_relevant_items(slave_items, master_items):
    # returns slave_items that are in master_items
    slave_skus = set([i['sku'] for i in slave_items])
    master_skus = set([i['sku'] for i in master_items])
    return [p for p in slave_items if p['sku'] in slave_skus & master_skus]


def get_relevant_orders(slave_orders, slave_items):
    # returns slave_order items that are in master_items
    orders_skus = set([i['sku'] for i in slave_orders])
    item_skus = set([i['sku'] for i in slave_items])
    return [o for o in slave_orders if o['sku'] in orders_skus & item_skus]
