#!/bin/bash
. db.conf
NEW_CUSTOMERS_ID_RESERVE=3
LAST_REAL_CUSTOMER=`mysql --column-names=FALSE -h${H} -u${RU} -p${RP} $D -e "SELECT customers_id FROM customers_real ORDER BY customers_id DESC LIMIT 1"`
echo '$LAST_REAL_CUSTOMER:' $LAST_REAL_CUSTOMER

LAST_EMPTY_CUSTOMERS_ID=`mysql --column-names=FALSE -h${H} -u${RU} -p${RP} $D -e "SELECT customers_id FROM last_empty_customers_id"`
echo 'LAST_EMPTY_CUSTOMERS_ID:' $LAST_EMPTY_CUSTOMERS_ID
if [[ $((LAST_REAL_CUSTOMER+NEW_CUSTOMERS_ID_RESERVE)) -le LAST_EMPTY_CUSTOMERS_ID ]]
then
  echo exit
	exit
else
  N=$((LAST_EMPTY_CUSTOMERS_ID+1))
  while [ $N -le $((LAST_EMPTY_CUSTOMERS_ID+NEW_CUSTOMERS_ID_RESERVE)) ]
  do
    mysql -h${H} -u${U} -p${P} $D -e "CREATE USER ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "GRANT USAGE on ${D}.* to ${D}_${N}@${H}"
#debug only!!!
#    mysql -h${H} -u${U} -p${P} $D -e "GRANT ALL on ${D}.* to ${D}_${N}@${H}"

    #TODO:otestovat contact_us!!!
    mysql -h${H} -u${U} -p${P} $D -e "grant INSERT on $D.action_recorder to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT, INSERT, UPDATE, DELETE on $D.address_book to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.address_format to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.advert to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.advert_info to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.article_reviews to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.article_reviews_description to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.articles to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.articles_blog to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.articles_description to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant UPDATE (articles_viewed) on $D.articles_description to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.articles_to_topics to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.articles_xsell to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.authors to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.authors_info to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.cache to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.categories to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.categories_description to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.configuration to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.configuration_group to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.countries to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.currencies to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.customer_data_groups to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.customer_data_groups_sequence to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT, INSERT, UPDATE on $D.customers to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.customers_anonym to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT, INSERT, UPDATE, DELETE on $D.customers_basket to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT, INSERT, UPDATE, DELETE on $D.customers_basket_attributes to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT, INSERT, UPDATE on $D.customers_info to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.geo_zones to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.hooks to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.information to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.information_group to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.languages to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.last_empty_customers_id to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.manufacturers to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.manufacturers_info to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.newsletters to ${D}_${N}@${H}"
#delete ne? TODO
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT, INSERT, UPDATE on $D.orders to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT, INSERT, UPDATE, DELETE on $D.orders_products to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT, INSERT, UPDATE, DELETE on $D.orders_products_attributes to ${D}_${N}@${H}"
#TODO jen select?
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.orders_products_download to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.orders_status to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT, INSERT on $D.orders_status_history to ${D}_${N}@${H}"
#TODO??
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT, INSERT, DELETE on $D.orders_total to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.pages to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.pages_description to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.products to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant UPDATE (products_quantity) on $D.products to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant UPDATE (products_ordered) on $D.products to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.products_attributes to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant UPDATE (options_values_quantity) on $D.products_attributes to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.products_attributes_download to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.products_description to ${D}_${N}@${H}"
##BACHA! otestovat
    mysql -h${H} -u${U} -p${P} $D -e "grant UPDATE (products_viewed) on $D.products_description to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.products_images to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT, INSERT, UPDATE, DELETE on $D.products_notifications to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.products_options to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.products_options_values to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.products_options_values_to_products_options to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.products_to_categories to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.reviews to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.reviews_description to ${D}_${N}@${H}"
##?????!!!! je treba
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.sec_directory_whitelist to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.sessions to ${D}_${N}@${H}"

    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.specials to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant UPDATE (status, date_status_change) on $D.specials to ${D}_${N}@${H}"
##?treba
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.tax_class to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.tax_rates to ${D}_${N}@${H}"
#???? update?
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT, INSERT, UPDATE, DELETE on $D.testimonials to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.testimonials_description to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.topics to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.topics_description to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT, INSERT, UPDATE, DELETE on $D.whos_online to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.zones to ${D}_${N}@${H}"
    mysql -h${H} -u${U} -p${P} $D -e "grant SELECT on $D.zones_to_geo_zones to ${D}_${N}@${H}"

echo NNN: ${N}
	  let N+=1
  done
  mysql -h${H} -u${U} -p${P} $D -e "FLUSH PRIVILEGES"
  mysql -h${H} -u${U} -p${P} $D -e "UPDATE last_empty_customers_id SET customers_id=$((N-1))"
fi

exit

#master admin
grant all privileges on mydatabase.* to masteradmin@dbserver identified by 'masteradminpassword' with grant option;
#catalog side user
grant usage on mydatabase.* to cataloguser@dbserver identified by 'cataloguserpassword';


