Install dependencies:
pip3 install -r requirements

How to run:
python3 synchronizer.py --slave_config path/to/slave_config.ini --master_config path/to/master_config.ini

How to run with debug messages:
python3 synchronizer.py --slave_config path/to/slave_config.ini --master_config path/to/master_config.ini -D

Functionalities:
- Update wordpress product quantity if postgres item quantity was changed
- Update wordpress product quantity if new order was created
- Update wordpress product quantity if both of above happen at the same time
- Update postgres product quantity if new order was created

- Product variations are flatten to regular products (with additional variation_id key) and handled by additional method to ensure data integrity
- Orders and order's line_items are aggregated and each product's quantity is summed up 

Edge cases:
- Script stops if there are no items in wordpress
- Script stops if there are no items in postgres
- Script stops if there are no matching items between wordpress and postgres

Error cases:
- Script raises exception if calculated quantity is less than 0 (may happen if someone at the same time subtracts item quantity from wordpress and postgres, just add quantity to postgres to fix it)
- Script raises exception if cannot send REST requests after all backoff retries

Data integrity:
- Only matching items (between postgres and wordpress by sku id) are updated
- Only "processing" type orders are evaluated (after evaluation order type is updated to "complete")
- All changes are rolled back if something with sql transaction goes wrong
