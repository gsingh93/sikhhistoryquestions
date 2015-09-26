#!/usr/bin/env python2

import config
import json
import MySQLdb
import sys


def main():
    if len(sys.argv) < 2:
        print 'Usage: %s questions_file' % sys.argv[0]
        exit(1)

    questions = None
    with open(sys.argv[1]) as f:
        questions = json.load(f)

    db = MySQLdb.connect(host=config.host, user=config.user, passwd=config.passwd, db=config.db)

    cur = db.cursor()
    cur.execute("DROP TABLE IF EXISTS %s" % config.table)
    cur.execute("CREATE TABLE %s (_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,"
                "question VARCHAR(4000) NOT NULL,"
                "answer VARCHAR(4000) NOT NULL)" % config.table)

    for q in questions:
        cur.execute("INSERT INTO %s (question, answer) VALUES ('%s', '%s')" %
                    (config.table, q['question'], q['answer']))

    db.commit()

    print 'Loaded %d questions into %s.%s' % (len(questions), config.db, config.table)


if __name__ == '__main__':
    main()
