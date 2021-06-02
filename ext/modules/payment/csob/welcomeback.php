<?php

/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
 */

chdir('../../../../');
require 'includes/application_top.php';
//$_POST['merchantData'] = json_decode('{"orderId":"153","customerId":"2","payment":"csob","sessiontoken":"80141a04586f19c76875123fd301ba5320d07ba790739754c3626fb8d83cdf0b"}'); 
//$_GET['ceid'] = 'm5ggd4u8fin67l1nomghba2s7m';
//$_POST['payId'] = '57073319ad58bGF';
//$_POST['dttm'] = '20210601192041';
//$_POST['resultCode'] = '0';
//$_POST['resultMessage'] = 'OK';
//$_POST['paymentStatus'] = '7';
//$_POST['signature'] = 'QZMT6vxy5DUKH9dVjtRt7fQsNcmEP%2Bnd%2B0T2AffABXBUiYYLjf%2BcHCB19LVR4LKM7L7ViShfN1ASvzxTgdbm%2Fd2MKZxg3NTqlHwdBI1Ik1D5ABww%2F6nikS21WBVZXUvZ8lrjDy8eA2GyKjPA0MkVFVqMksxxJbnwhIZYFcW7BZJ6yAc0NioYhMCvW38SD%2BDo1t7Rk9ljMtQlmEDB2rLWZXGT6JMKZVwvwrTbypmuEMUKdofPssXSdVxSdkmg%2BtEy5tSIiKUyoASX1eF%2BtzPswHlLZ5lgd%2BOJmDIXKYMJyHH283Mf61BH3ow9XZ6MDpTGJ7Xs6wx5EyQrubWHMgg4SA%3D%3D&authCode=654344&merchantData=eyJvcmRlcklkIjoiMTUxIiwiY3VzdG9tZXJJZCI6IjIiLCJwYXltZW50IjoiY3NvYiIsInNlc3Npb250b2tlbiI6IjgwMTQxYTA0NTg2ZjE5Yzc2ODc1MTIzZmQzMDFiYTUzMjBkMDdiYTc5MDczOTc1NGMzNjI2ZmI4ZDgzY2RmMGIifQ%3D%3D' ;    

$cartPayId = \Ease\WebPage::getRequestValue('payId');
$cardDttm = \Ease\WebPage::getRequestValue('dttm');



$merchantData = json_decode(base64_decode(\Ease\WebPage::getRequestValue('merchantData')), 'true');
$paymentStatus = \Ease\WebPage::getRequestValue('paymentStatus', 'int');
$resultCode = \Ease\WebPage::getRequestValue('resultCode', 'int');

$GLOBALS['order_id'] = $merchantData['orderId'];
$GLOBALS['order'] = Guarantor::ensure_global('PureOSC\Order', array_key_exists('order_id', $GLOBALS) ? $GLOBALS['order_id'] : null);

$payment_modules = new \payment($merchantData['payment']);
$payment_modules->update_status();

if (( is_array($payment_modules->modules) && (count($payment_modules->modules) > 1) && !is_object(${$_SESSION['payment']}) ) || (is_object(${$_SESSION['payment']}) && (${$_SESSION['payment']}->enabled == false))) {
    tep_redirect(tep_href_link('checkout_payment.php', 'error_message=' . urlencode(ERROR_NO_PAYMENT_MODULE_SELECTED), 'SSL'));
}

if (is_array($payment_modules->modules)) {
    $payment_modules->pre_confirmation_check();
}
