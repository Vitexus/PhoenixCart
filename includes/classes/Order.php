<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PureOSC;

/**
 * Description of Order
 *
 * @author vitex
 */
class Order extends \order {

    public function __construct($order_id = null) {
        $this->customer['id'] = null;

        if ($order_id === false) {
            $this->set_id(null);
        } else {
            parent::__construct($order_id);
            $this->set_id($order_id);
            self::updateTotals();
        }
    }

    public function updateTotals() {
        $order_total_modules = new order_total();
        $order->totals = $order_total_modules->process();
    }

    public function getStatus() {
        return array_key_exists('orders_status_id', $this->info) ? intval($this->info['orders_status_id']) : 0;
    }

    public function setOrderState(int $code) {
        if (tep_db_query("UPDATE orders SET orders_status = " . $code . ", last_modified = NOW() WHERE orders_id = " . (int) $this->get_id())) {
            $this->info['orders_status_id'] = $code;
        }
    }

    public function addStatusHistory(int $orderStatusId, $comments = '') {
        tep_db_query("INSERT INTO orders_status_history (orders_id, orders_status_id, date_added, comments) VALUES ('" . $this->get_id() . "', '" . $orderStatusId . "', NOW(), '" . tep_db_input($comments) . "')");
    }

    public static function redirectForOrderStatus(int $orderStatusId) {
        switch ($orderStatusId) {
            case intval(MODULE_PAYMENT_CSOB_CANCELED_ORDER_STATUS_ID):
                tep_redirect(tep_href_link('shopping_cart.php', '', 'SSL'));
                break;
            case intval(MODULE_PAYMENT_CSOB_PROCESSING_ORDER_STATUS_ID):
                tep_redirect(tep_href_link('account_history.php', '', 'SSL'));
                break;
            case intval(MODULE_PAYMENT_CSOB_DONE_ORDER_STATUS_ID):
                tep_redirect(tep_href_link('checkout_success.php', '', 'SSL'));
                break;
            case intval(MODULE_PAYMENT_CSOB_PROBLEM_ORDER_STATUS_ID):
                tep_redirect(tep_href_link('checkout_payment.php', 'payment_error=' . 'csob' . '&error=' . $resultCode));
                break;
        }
    }

}
