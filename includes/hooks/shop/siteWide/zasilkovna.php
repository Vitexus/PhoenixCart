<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of hook_shop_siteWide_zasilkovna
 *
 * @author vitex
 */
class hook_shop_siteWide_zasilkovna {

    public $version = '0.0.1';

    public function __construct() {
        echo '';
    }

    function listen_injectFormDisplay() {
        return new \Ease\TWB4\Alert('danger', 'Okolo');
    }

}
