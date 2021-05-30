#!/bin/bash
#TODO: SETUP configurable db_prefix SUBSTR(SUBSTRING_INDEX("od_231", "@", 1),n)
# n=db_name plus '_'
. db.conf
SHIFTME1=${#D}
SHIFTME=$((SHIFTME1 + 2))
echo $SHIFTME
sed  "s/SHIFTME/${SHIFTME}/g" < view_tpl.sql > view_tmp.sql
sed -i "s/rootadmin/${RU}/g" view_tmp.sql
mysql -h${H} -u${U} -p${P} ${D} < view_tmp.sql
rm view_tmp.sql
  mysql -h${H} -u${U} -p${P} ${D} -e "DROP USER ${RU}@${HH}"
  mysql -h${H} -u${U} -p${P} -e "GRANT ALL on ${D}.* to ${RU}@${HH} identified by '${RP}' WITH GRANT OPTION";

    mysql -h${H} -u${U} -p${P} ${D} -e "DROP USER ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "CREATE USER ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "GRANT USAGE on ${D}.* to ${A}@${HH} IDENTIFIED BY '${PA}'"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant INSERT on ${D}.action_recorder to ${A}@${HH}"

#    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT, INSERT, UPDATE, DELETE on ${D}.address_book to ${A}@${HH}"
#    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.address_format to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.advert to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.advert_info to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.article_reviews to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.article_reviews_description to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.articles to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.articles_blog to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.articles_description to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant UPDATE (articles_viewed) on $D.articles_description to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.articles_images to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.articles_to_topics to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.articles_xsell to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.authors to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.authors_info to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.cache to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.categories to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.categories_description to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.configuration to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.configuration_group to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.countries to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.currencies to ${A}@${HH}"

#??????!!!!!!!!!!!!!!!!!!!!!!!!! extremDirtyHack - presunout pripojeni databaze na konec
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.customers to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.address_book to ${A}@${HH}"

    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.customer_data_groups to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.customer_data_groups_sequence to ${A}@${HH}"

    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.customers_anonym to ${A}@${HH}"
#    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT, INSERT, UPDATE on ${D}.customers to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT, INSERT, UPDATE, DELETE on ${D}.customers_basket to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT, INSERT, UPDATE, DELETE on ${D}.customers_basket_attributes to ${A}@${HH}"

    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.customers_info to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant UPDATE (customers_info_date_of_last_logon) on ${D}.customers_info to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant UPDATE (customers_info_number_of_logons) on ${D}.customers_info to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant UPDATE (password_reset_key) on ${D}.customers_info to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant UPDATE (password_reset_date) on ${D}.customers_info to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.geo_zones to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.hooks to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.information to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.information_group to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.languages to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.last_empty_customers_id to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.manufacturers to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.manufacturers_info to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.newsletters to ${A}@${HH}"

#delete ne? TODO
#    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT, INSERT, UPDATE on ${D}.orders to ${A}@${HH}"
#    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT, INSERT, UPDATE, DELETE on ${D}.orders_products to ${A}@${HH}"
#    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT, INSERT, UPDATE, DELETE on ${D}.orders_products_attributes to ${A}@${HH}"
#TODO jen select?
#    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.orders_products_download to ${A}@${HH}"
#    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.orders_status to ${A}@${HH}"
#    mysql -h${H} -u${U} -p${P} ${D} -e "grant INSERT on ${D}.orders_status_history to ${A}@${HH}"
#TODO??
#    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT, INSERT, DELETE on ${D}.orders_total to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.pages to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.pages_description to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.products to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.products_attributes to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.products_attributes_download to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.products_description to ${A}@${HH}"
##BACHA! otestovat PRAVA NA SLOUPCE!!!
    mysql -h${H} -u${U} -p${P} ${D} -e "grant UPDATE (products_viewed) on ${D}.products_description to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.products_images to ${A}@${HH}"
#    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT, INSERT, UPDATE, DELETE on ${D}.products_notifications to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.products_options to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.products_options_values to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.products_options_values_to_products_options to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.products_to_categories to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.reviews to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.reviews_description to ${A}@${HH}"
##?????!!!! je treba
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.sec_directory_whitelist to ${A}@${HH}"
#??????? Needed only if sessions are stored in DB
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT, INSERT, UPDATE, DELETE on ${D}.sessions to ${A}@${HH}"
#todo omezit prava!!
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT, UPDATE on ${D}.specials to ${A}@${HH}"
##?treba
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.tax_class to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.tax_rates to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.testimonials to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.testimonials_description to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.topics to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.topics_description to ${A}@${HH}"
#vsechny prava? otestovat
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT, INSERT, UPDATE, DELETE on ${D}.whos_online to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.zones to ${A}@${HH}"
    mysql -h${H} -u${U} -p${P} ${D} -e "grant SELECT on ${D}.zones_to_geo_zones to ${A}@${HH}"

    mysql -h${H} -u${U} -p${P} ${D} -e "grant UPDATE on ${D}.articles_description to ${A}@${HH}"

  mysql -h${H} -u${U} -p${P} -e "FLUSH PRIVILEGES"





exit

#master admin
grant all privileges on mydatabase.* to masteradmin@dbserver identified by 'masteradminpassword' with grant option;
#catalog side user
grant usage on mydatabase.* to cataloguser@dbserver identified by 'cataloguserpassword';


