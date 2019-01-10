from contextlib import contextmanager
from functools import wraps

import logging
import random
import time


logger = logging.getLogger('synchronizer')


class RestException(Exception):
    pass


@contextmanager
def transaction(conn, logger):
    # Closes curor after transaction or error
    # Rolls back changes if error occurs
    cursor = conn.cursor()
    try:
        yield cursor
    except Exception as e:
        cursor.execute('ROLLBACK')
        logger.info("ERROR: Changes rolled back")
        raise e
    finally:
        cursor.close()


def backoff(func):
    # Exponential backoff algorithm
    retry = 3

    @wraps(func)
    def inner(*args, **kwargs):
        err = None
        for r in range(retry):
            try:
                return func(*args, **kwargs)
            except Exception as e:
                logger.info("ERROR: {}/{} retry".format(r + 1, retry))
                time.sleep(random.uniform(0.01, 0.5) + 2**(r))
                err = e
        raise err
    return inner
