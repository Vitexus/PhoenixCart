<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
*/

  class OSCOM_PayPal_LOGIN_Cfg_sandbox_secret {
    var $default = '';
    var $sort_order = 500;

    function __construct() {
      global $OSCOM_PayPal;

      $this->title = $OSCOM_PayPal->getDef('cfg_login_sandbox_secret_title');
      $this->description = $OSCOM_PayPal->getDef('cfg_login_sandbox_secret_desc');
    }

    function getSetField() {
      $input = new Input('sandbox_secret', ['value' => OSCOM_APP_PAYPAL_LOGIN_SANDBOX_SECRET, 'id' => 'inputLogInSandboxSecret']);

      $result = <<<EOT
<h5>{$this->title}</h5>
<p>{$this->description}</p>

<div class="mb-3">{$input}</div>
EOT;

      return $result;
    }
  }
