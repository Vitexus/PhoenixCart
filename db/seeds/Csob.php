<?php

use Phinx\Seed\AbstractSeed;

class Csob extends AbstractSeed {

    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run() {
        $this->execute("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, set_function) VALUES ('Enable CSOB Payment gateway Module', 'MODULE_PAYMENT_CSOB_STATUS', 'True', 'Do you want to accept CSOB Payment gateway payments?', '6', '1', NOW(), 'tep_cfg_select_option([\'True\', \'False\'], ') ");
        $this->execute("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, set_function, use_function) VALUES ('Payment Zone', 'MODULE_PAYMENT_CSOB_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', NOW(), 'tep_cfg_pull_down_zone_classes(', 'tep_get_zone_class_title') ");
        $this->execute("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Sort order of display.', 'MODULE_PAYMENT_CSOB_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '3', NOW()) ");
        $this->execute("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, set_function, use_function) VALUES ('Set Order Status', 'MODULE_PAYMENT_CSOB_ORDER_STATUS_ID', '5', 'Set the status of orders made with this payment module to this value', '6', '4', NOW(), 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name') ");
        $this->execute("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Your merchant id', 'MODULE_PAYMENT_CSOB_MERCHANT_ID', '00000000', 'Your merchant unique identifier (supplied by csob)', '6', '5', NOW()) ");
        $this->execute("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Your secret key', 'MODULE_PAYMENT_CSOB_SECRET_KEY', '', 'Your secret key (supplied by csob on https://platebnibrana.csob.cz/keygen/)', '6', '6', NOW()) ");
        $this->execute("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) VALUES ('Your public key', 'MODULE_PAYMENT_CSOB_PUBLIC_KEY', 'mips_iplatebnibrana.csob.cz.pub', 'Your public key (supplied by csob)', '6', '7', NOW()) ");
        $this->execute("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, set_function, use_function) VALUES ('Payment in progress Order Status', 'MODULE_PAYMENT_CSOB_PROCESSING_ORDER_STATUS_ID', '8', 'State for orders with payment in progress', '6', '8', NOW(), 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name') ");
        $this->execute("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, set_function, use_function) VALUES ('All OK settled payment Order Status', 'MODULE_PAYMENT_CSOB_DONE_ORDER_STATUS_ID', '6', 'Include transaction information in this order status level', '6', '9', NOW(), 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name') ");
        $this->execute("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, set_function, use_function) VALUES ('Canceled payment Order Status', 'MODULE_PAYMENT_CSOB_CANCELED_ORDER_STATUS_ID', '7', 'State for orders with cancelled paymen', '6', '10', NOW(), 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name') ");
        $this->execute("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, set_function, use_function) VALUES ('Card payment problem Order Status', 'MODULE_PAYMENT_CSOB_PROBLEM_ORDER_STATUS_ID', '9', 'Include transaction information in this order status level', '6', '11', NOW(), 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name') ");
        $this->execute("INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, set_function) VALUES ('Use production API', 'MODULE_PAYMENT_CSOB_PRODUCTION', 'False', 'Put false here to use testing API servers.', '6', '12', NOW(), 'tep_cfg_select_option([\'True\', \'False\'], ') ");
        $this->execute("UPDATE configuration SET configuration_value = 'csob.php' WHERE configuration_key = 'MODULE_PAYMENT_INSTALLED' ");

        $this->execute("UPDATE configuration SET configuration_value = 'True' WHERE configuration_key = 'MODULE_PAYMENT_CSOB_STATUS'");
        $this->execute("UPDATE configuration SET configuration_value = '0' WHERE configuration_key = 'MODULE_PAYMENT_CSOB_ZONE' ");
        $this->execute("UPDATE configuration SET configuration_value = '0' WHERE configuration_key = 'MODULE_PAYMENT_CSOB_SORT_ORDER' ");
        $this->execute("UPDATE configuration SET configuration_value = '5' WHERE configuration_key = 'MODULE_PAYMENT_CSOB_ORDER_STATUS_ID' ");
        $this->execute("UPDATE configuration SET configuration_value = 'A52158l6SC' WHERE configuration_key = 'MODULE_PAYMENT_CSOB_MERCHANT_ID' ");
        $this->execute("UPDATE configuration SET configuration_value = 'keys/rsa_A52158l6SC.key' WHERE configuration_key = 'MODULE_PAYMENT_CSOB_SECRET_KEY' "); //TODO Auto Find
        $this->execute("UPDATE configuration SET configuration_value = 'keys/mips_iplatebnibrana.csob.cz.pub' WHERE configuration_key = 'MODULE_PAYMENT_CSOB_PUBLIC_KEY' "); //TODO Auto Find
        $this->execute("UPDATE configuration SET configuration_value = '8' WHERE configuration_key = 'MODULE_PAYMENT_CSOB_PROCESSING_ORDER_STATUS_ID' ");
        $this->execute("UPDATE configuration SET configuration_value = '6' WHERE configuration_key = 'MODULE_PAYMENT_CSOB_DONE_ORDER_STATUS_ID' ");
        $this->execute("UPDATE configuration SET configuration_value = '7' WHERE configuration_key = 'MODULE_PAYMENT_CSOB_CANCELED_ORDER_STATUS_ID' ");
        $this->execute("UPDATE configuration SET configuration_value = '9' WHERE configuration_key = 'MODULE_PAYMENT_CSOB_PROBLEM_ORDER_STATUS_ID' ");
        $this->execute("UPDATE configuration SET configuration_value = 'False' WHERE configuration_key = 'MODULE_PAYMENT_CSOB_PRODUCTION' ");
    }

}
