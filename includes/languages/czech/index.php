<?php

/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
 */

const TEXT_MAIN = 'xxx';
const TABLE_HEADING_NEW_PRODUCTS = 'Novinky %s';
const TABLE_HEADING_UPCOMING_PRODUCTS = 'Připravujeme';
const TABLE_HEADING_DATE_EXPECTED = 'Bude k dispozici';
define('HEADING_TITLE', 'Vítejte na serveru ' . STORE_NAME);

const TEXT_NO_PRODUCTS = 'V této kategorii není žádné zboží.';
const TEXT_NUMBER_OF_PRODUCTS = 'Počet: ';
const TEXT_SHOW = '<strong>vyberte:</strong>';
const TEXT_BUY = 'Koupit ';
const TEXT_NOW = 'nyní';
const TEXT_ALL_CATEGORIES = 'všechny kategorie';
const TEXT_ALL_MANUFACTURERS = 'všichni výrobci';

// seo
if (($category_depth == 'top') && (!isset($_GET['manufacturers_id']))) {
    define('META_SEO_TITLE', 'Index stránka název');
    define('META_SEO_DESCRIPTION',
            'Toto je popis vašeho webu, který se má použít v popisovacím prvku META');
    /*
      keywords are USELESS unless you are selling into China and want to be listed in Baidu Search Engine
     */
    define('META_SEO_KEYWORDS',
            'tato, čárkami, oddělená, klíčová, slova, použitá v META keywords prvku');
}

