<?php

class csob_hook_admin_orders_action {

    public function execute() {
        echo 'csob_hook_admin_orders_action';

        if (array_key_exists('tabaction', $_REQUEST) && ( $_REQUEST['tabaction'] == 'refundTransaction')) {
            if (array_key_exists('oID', $_REQUEST)) {
                $order = Guarantor::ensure_global('PureOSC\Order', $_REQUEST['oID']);
                $payment = new \PureOSC\Payment($order);
                
                try {
                    $refund = $payment->getApi()->paymentRefund($payment->payId);
                    echo new \Ease\TWB4\Alert('success', 'A');
                } catch (\OndraKoupil\Csob\Exception $exc) {
                    echo new \Ease\TWB4\Alert('warning', $exc->getMessage());
                    
//                    echo $exc->getTraceAsString();
                }

            }
        }
    }

}
