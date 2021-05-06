<?php

/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
 */

class hook_shop_siteWide_csob {

    public $version = '0.0.1';

    /**
     * Order handle
     * @var \PureOSC\Order
     */
    public $order = null;

    /**
     * 
     * @var array
     */
    private $paymentData;

    public function listen_paymentStart() {
        $cartPayId = \Ease\WebPage::getRequestValue('payId');
        $cardDttm = \Ease\WebPage::getRequestValue('dttm');

        $merchantData = json_decode(base64_decode(\Ease\WebPage::getRequestValue('merchantData')), 'true');
        $paymentStatus = \Ease\WebPage::getRequestValue('paymentStatus', 'int');
        $resultCode = \Ease\WebPage::getRequestValue('resultCode', 'int');

        $GLOBALS['order_id'] = $merchantData['orderId'];
        $GLOBALS['order'] = Guarantor::ensure_global('PureOSC\Order', array_key_exists('order_id', $GLOBALS) ? $GLOBALS['order_id'] : null);

        $payment_modules = new \payment($merchantData['payment']); 
        $payment_modules->update_status(); 

        ${$_SESSION['payment']} = Guarantor::ensure_global($_SESSION['payment']);
        if (( is_array($payment_modules->modules) &&
                (count($payment_modules->modules) > 1) &&
                (is_object(${$_SESSION['payment']}) &&
                (${$_SESSION['payment']}->enabled == false)
                ))) {
            tep_redirect(tep_href_link('checkout_payment.php', 'error_message=' . urlencode(ERROR_NO_PAYMENT_MODULE_SELECTED), 'SSL'));
        }

        if (is_array($payment_modules->modules)) {
            $payment_modules->pre_confirmation_check();
        }
    }

    /**
     * 
     * @param PureOSC\Order $order
     */
    public function listen_constructOrder(\order $order) {
        $orderId = $order->get_id();
        if ($orderId) {
//            $payment = new PureOSC\Payment($order);
//            $status = $payment->requestStatus();
        }
    }

    public function listen_databaseOrderBuild($param) {
        //Order was loaded from data base, so we can check card payment status
        $this->order = $param['order'];
//          if($this->order->getPaymentState() == 'unknown'){
//        $this->order->getPaymentStatus();
//          }
    }

}
