<?php

class hook_shop_payment_csob {

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
    
    public function __construct() {
        echo '';
    }

    public function listen_autosync() {
        echo '';
    }

    public function paymentStart() {
        echo '';
    }
    
}
