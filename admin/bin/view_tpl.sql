--
-- Final view structure for view `address_book`
--

/*!50001 DROP TABLE IF EXISTS `address_book`*/;
/*!50001 DROP VIEW IF EXISTS `address_book`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `address_book` AS select `address_book_real`.`address_book_id` AS `address_book_id`,`address_book_real`.`customers_id` AS `customers_id`,`address_book_real`.`entry_gender` AS `entry_gender`,`address_book_real`.`entry_company` AS `entry_company`,`address_book_real`.`entry_firstname` AS `entry_firstname`,`address_book_real`.`entry_lastname` AS `entry_lastname`,`address_book_real`.`entry_street_address` AS `entry_street_address`,`address_book_real`.`entry_suburb` AS `entry_suburb`,`address_book_real`.`entry_postcode` AS `entry_postcode`,`address_book_real`.`entry_city` AS `entry_city`,`address_book_real`.`entry_state` AS `entry_state`,`address_book_real`.`entry_country_id` AS `entry_country_id`,`address_book_real`.`entry_zone_id` AS `entry_zone_id` from `address_book_real` where `address_book_real`.`customers_id` = (select substr(substring_index(user(),'@',1),5)) or substring_index(user(),'@',1) = 'rootadmin' */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `customers`
--

/*!50001 DROP TABLE IF EXISTS `customers`*/;
/*!50001 DROP VIEW IF EXISTS `customers`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `customers` AS select `customers_real`.`customers_id` AS `customers_id`,`customers_real`.`customers_gender` AS `customers_gender`,`customers_real`.`customers_firstname` AS `customers_firstname`,`customers_real`.`customers_lastname` AS `customers_lastname`,`customers_real`.`customers_dob` AS `customers_dob`,`customers_real`.`customers_email_address` AS `customers_email_address`,`customers_real`.`customers_default_address_id` AS `customers_default_address_id`,`customers_real`.`customers_telephone` AS `customers_telephone`,`customers_real`.`customers_fax` AS `customers_fax`,`customers_real`.`customers_password` AS `customers_password`,`customers_real`.`customers_newsletter` AS `customers_newsletter`,`customers_real`.`customers_company_number` AS `customers_company_number`,`customers_real`.`customers_vat_number` AS `customers_vat_number` from `customers_real` where `customers_real`.`customers_id` = (select substr(substring_index(user(),'@',1),5)) or substring_index(user(),'@',1) = 'rootadmin' */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `customers_anonym`
--

/*!50001 DROP TABLE IF EXISTS `customers_anonym`*/;
/*!50001 DROP VIEW IF EXISTS `customers_anonym`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `customers_anonym` AS select `customers_real`.`customers_id` AS `customers_id`,`customers_real`.`customers_email_address` AS `customers_email_address`,`customers_real`.`customers_password` AS `customers_password` from `customers_real` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `orders`
--

/*!50001 DROP TABLE IF EXISTS `orders`*/;
/*!50001 DROP VIEW IF EXISTS `orders`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `orders` AS select `orders_real`.`orders_id` AS `orders_id`,`orders_real`.`customers_id` AS `customers_id`,`orders_real`.`customers_name` AS `customers_name`,`orders_real`.`customers_company` AS `customers_company`,`orders_real`.`customers_street_address` AS `customers_street_address`,`orders_real`.`customers_suburb` AS `customers_suburb`,`orders_real`.`customers_city` AS `customers_city`,`orders_real`.`customers_postcode` AS `customers_postcode`,`orders_real`.`customers_state` AS `customers_state`,`orders_real`.`customers_country` AS `customers_country`,`orders_real`.`customers_telephone` AS `customers_telephone`,`orders_real`.`customers_email_address` AS `customers_email_address`,`orders_real`.`customers_address_format_id` AS `customers_address_format_id`,`orders_real`.`delivery_name` AS `delivery_name`,`orders_real`.`delivery_company` AS `delivery_company`,`orders_real`.`delivery_street_address` AS `delivery_street_address`,`orders_real`.`delivery_suburb` AS `delivery_suburb`,`orders_real`.`delivery_city` AS `delivery_city`,`orders_real`.`delivery_postcode` AS `delivery_postcode`,`orders_real`.`delivery_state` AS `delivery_state`,`orders_real`.`delivery_country` AS `delivery_country`,`orders_real`.`delivery_address_format_id` AS `delivery_address_format_id`,`orders_real`.`billing_name` AS `billing_name`,`orders_real`.`billing_company` AS `billing_company`,`orders_real`.`billing_street_address` AS `billing_street_address`,`orders_real`.`billing_suburb` AS `billing_suburb`,`orders_real`.`billing_city` AS `billing_city`,`orders_real`.`billing_postcode` AS `billing_postcode`,`orders_real`.`billing_state` AS `billing_state`,`orders_real`.`billing_country` AS `billing_country`,`orders_real`.`billing_address_format_id` AS `billing_address_format_id`,`orders_real`.`payment_method` AS `payment_method`,`orders_real`.`cc_type` AS `cc_type`,`orders_real`.`cc_owner` AS `cc_owner`,`orders_real`.`cc_number` AS `cc_number`,`orders_real`.`cc_expires` AS `cc_expires`,`orders_real`.`last_modified` AS `last_modified`,`orders_real`.`date_purchased` AS `date_purchased`,`orders_real`.`orders_status` AS `orders_status`,`orders_real`.`orders_date_finished` AS `orders_date_finished`,`orders_real`.`currency` AS `currency`,`orders_real`.`currency_value` AS `currency_value` from `orders_real` where `orders_real`.`customers_id` = (select substr(substring_index(user(),'@',1),5)) or substring_index(user(),'@',1) = 'rootadmin' */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

