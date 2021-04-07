<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
 */

const NAVBAR_TITLE = 'Obsah košíku';
const HEADING_TITLE = 'Obsah košíku';
const TEXT_CART_EMPTY = 'Váš košík je prázdný!';
const SUB_TITLE_SUB_TOTAL = 'celkem zboží:';
const SUB_TITLE_TOTAL = 'Celkem k úhradě:';

define('OUT_OF_STOCK_CANT_CHECKOUT',
    'Zboží označené '.STOCK_MARK_PRODUCT_OUT_OF_STOCK.' dont exist in desired quantity in our stock.<br />Please alter the quantity of products marked with ('.STOCK_MARK_PRODUCT_OUT_OF_STOCK.'), Thank you',
    true);
define('OUT_OF_STOCK_CAN_CHECKOUT',
    'Zboží označené '.STOCK_MARK_PRODUCT_OUT_OF_STOCK.' dont exist in desired quantity in our stock.<br />You can buy them anyway and check the quantity we have in stock for immediate deliver in the checkout process.',
    true);

const TEXT_ALTERNATIVE_CHECKOUT_METHODS = '- OR -';
const FREE_SHIPPING_REMAINING_1 = 'Nakupte ještě za ';
const FREE_SHIPPING_REMAINING_2 = ' a získejte dopravu zdarma';
const REMOVE_FROM_CART = 'Odstranit';
