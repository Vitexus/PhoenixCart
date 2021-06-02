<?php

/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
 */

class hook_shop_checkout_payment_stage_csob {

    public $version = '1.0.0';

    public function __construct() {
        $this->listen_injectSiteStart();
    }

    public function listen_injectSiteStart() {

        $cartPayId = \Ease\WebPage::getRequestValue('payId');
        $cardDttm = \Ease\WebPage::getRequestValue('dttm');

        if ($cartPayId && $cardDttm) { //PayGW Responsed
            $merchantData = json_decode(trim(base64_decode(\Ease\WebPage::getRequestValue('merchantData'))), 'true');
            $paymentStatus = \Ease\WebPage::getRequestValue('paymentStatus', 'int');
            $resultCode = \Ease\WebPage::getRequestValue('resultCode', 'int');

            $GLOBALS['order_id'] = $merchantData['orderId'];
            $GLOBALS['order'] = Guarantor::ensure_global('PureOSC\Order', array_key_exists('order_id', $GLOBALS) ? $GLOBALS['order_id'] : null);

            $payment_modules = new \payment($merchantData['payment']);
            $payment_modules->update_status();

//    if (( is_array($payment_modules->modules) && (count($payment_modules->modules) > 1) && isset(${$_SESSION['payment']}) && !is_object(${$_SESSION['payment']}) ) || (is_object(${$_SESSION['payment']}) && (${$_SESSION['payment']}->enabled == false))) {
//        tep_redirect(tep_href_link('checkout_payment.php', 'error_message=' . urlencode(ERROR_NO_PAYMENT_MODULE_SELECTED), 'SSL'));
//    }
            if (is_array($payment_modules->modules)) {
                $payment_modules->pre_confirmation_check();
            }
        } else {

#http://phoenix/checkout_payment.php?error_message=Vyberte%2Bzp%C5%AFsob%2Bplatby%2BVa%C5%A1%C3%AD%2Bobjedn%C3%A1vky.&ceid=74nt479h4qr44krdtsd5c2dioa
        }
    }

}
