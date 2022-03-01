<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2014 osCommerce

  Released under the GNU General Public License
*/

  class OSCOM_PayPal_LOGIN_Cfg_sort_order {
    var $default = '0';
    var $title;
    var $description;
    var $app_configured = false;

    function __construct() {
      global $OSCOM_PayPal;

      $this->title = $OSCOM_PayPal->getDef('cfg_login_sort_order_title');
      $this->description = $OSCOM_PayPal->getDef('cfg_login_sort_order_desc');
    }

    function getSetField() {
      $input = new Input('sort_order', ['value' => OSCOM_APP_PAYPAL_LOGIN_SORT_ORDER, 'id' => 'inputLogInSortOrder']);

      $result = <<<EOT
<h5>{$this->title}</h5>
<p>{$this->description}</p>

<div class="mb-3">{$input}</div>
EOT;

      return $result;
    }
  }
