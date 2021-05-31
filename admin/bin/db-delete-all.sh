#!/bin/bash
. db.conf
#empty users, orders TODO
mysql -u $U -p${P} ${D} -e 'truncate customers_real'
mysql -u $U -p${P} ${D} -e 'truncate customers_info'
mysql -u $U -p${P} ${D} -e 'truncate address_book_real' 
for i in {1..3}
  do
    mysql -u $U -p${P} ${D} -e "drop user ${D}_${i}@${H}"
done

mysql -h${H} -u${U} -p${P} ${D} -e "DROP USER ${RU}@${HH}"
mysql -h${H} -u${U} -p${P} ${D} -e "DROP USER ${A}@${HH}"

mysql -u $U -p${P} ${D} -e 'update last_empty_customers_id set customers_id = 0'