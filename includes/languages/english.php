<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Array examples which should work on all servers:
// 'en_US.UTF-8', 'en_US.UTF8', 'enu_usa'
// 'en_GB.UTF-8', 'en_GB.UTF8', 'eng_gb'
// 'en_AU.UTF-8', 'en_AU.UTF8', 'ena_au'
@setlocale(LC_ALL, ['en_US.UTF-8', 'en_US.UTF8', 'enu_usa']);

const DATE_FORMAT_SHORT = '%m/%d/%Y';  // this is used for strftime()
const DATE_FORMAT_LONG = '%A %d %B, %Y'; // this is used for strftime()
const DATE_FORMAT = 'm/d/Y'; // this is used for date()
const DATE_TIME_FORMAT = DATE_FORMAT_SHORT . ' %H:%M:%S';

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the application's default currency (used when changing language)
const LANGUAGE_CURRENCY = 'USD';

// Global entries for the <html> tag
const HTML_PARAMS = '';

// charset for web pages and emails
const CHARSET = 'utf-8';

// page title
const TITLE = STORE_NAME;

// text in includes/modules/downloads.php
const HEADER_TITLE_MY_ACCOUNT = 'My Account';

// checkout procedure text
const CHECKOUT_BAR_DELIVERY = 'Delivery Information';
const CHECKOUT_BAR_PAYMENT = 'Payment Information';
const CHECKOUT_BAR_CONFIRMATION = 'Confirmation';

// pull down default text
const PULL_DOWN_DEFAULT = 'Please Select';

// javascript messages
const JS_ERROR = 'Errors have occured during the process of your form.\n\nPlease make the following corrections:\n\n';

const JS_ERROR_NO_PAYMENT_MODULE_SELECTED = '* Please select a payment method for your order.\n';

const ERROR_NO_PAYMENT_MODULE_SELECTED = 'Please select a payment method for your order.';

const IMAGE_BUTTON_ADD_ADDRESS = 'Add Address';
const IMAGE_BUTTON_BACK = 'Back';
const IMAGE_BUTTON_BUY_NOW = 'Buy Now';
const IMAGE_BUTTON_CHANGE_ADDRESS = 'Change Address';
const IMAGE_BUTTON_CHECKOUT = 'Checkout';
const IMAGE_BUTTON_CONFIRM_ORDER = 'Confirm Order';
const IMAGE_BUTTON_CONTINUE = 'Continue';
const IMAGE_BUTTON_DELETE = 'Delete';
const IMAGE_BUTTON_LOGIN = 'Sign In';
const IMAGE_BUTTON_IN_CART = 'Add to Cart';
const IMAGE_BUTTON_SEARCH = 'Search';
const IMAGE_BUTTON_UPDATE = 'Update';
const IMAGE_BUTTON_UPDATE_PREFERENCES = 'Update Preferences';

const SMALL_IMAGE_BUTTON_DELETE = 'Delete';
const SMALL_IMAGE_BUTTON_EDIT = 'Edit';
const SMALL_IMAGE_BUTTON_VIEW = 'View';
const SMALL_IMAGE_BUTTON_BUY = 'Buy';

const TEXT_CCVAL_ERROR_INVALID_DATE = 'The expiry date entered for the credit card is invalid. Please check the date and try again.';
const TEXT_CCVAL_ERROR_INVALID_NUMBER = 'The credit card number entered is invalid. Please check the number and try again.';
const TEXT_CCVAL_ERROR_UNKNOWN_CARD = 'The first four digits of the number entered are: %s. If that number is correct, we do not accept that type of credit card. If it is wrong, please try again.';

const TEXT_SEARCH_PLACEHOLDER = 'Search';

// message for required inputs
const FORM_REQUIRED_INFORMATION = '<i class="fas fa-asterisk text-danger"></i> Required information';
const FORM_REQUIRED_INPUT = '<span class="form-control-feedback text-danger"><i class="fas fa-asterisk"></i></span>';

// product notifications
const PRODUCT_SUBSCRIBED = '%s has been added to your Notification List';
const PRODUCT_UNSUBSCRIBED = '%s has been removed from your Notification List';
const PRODUCT_ADDED = '%s has been added to your Cart';
const PRODUCT_REMOVED = '%s has been removed from your Cart';

// bootstrap helper
const MODULE_CONTENT_BOOTSTRAP_ROW_DESCRIPTION = '';

// noscript helper
const TEXT_NOSCRIPT = <<<'EOT'
<p><strong>JavaScript seems to be disabled in your browser.</strong></p>
<p>You must have JavaScript enabled in your browser to utilize the functionality of this website.<br>
<a class="alert-link" href="https://www.enable-javascript.com/" target="_blank" rel="noreferrer">Click here for instructions on enabling javascript in your browser</a>.</p>
EOT;

// for new style internal pages
const LINK_TEXT_EDIT = '<small><a class="%s" href="%s">Edit</a></small>';
const SHIPPING_FA_ICON = '<i class="fas fa-shipping-fast fa-fw fa-3x float-right text-black-50"></i>';
const PAYMENT_FA_ICON = '<i class="fas fa-file-invoice-dollar fa-fw fa-3x float-right text-black-50"></i>';

const ENTRY_COMMENTS = 'Anything we need to know?';
const ENTRY_COMMENTS_PLACEHOLDER = 'Comment here...';
<<<<<<< HEAD
const TABLE_HEADING_OR = '-or-';

const TEXT_UNKNOWN_TAX_RATE ='EROR: TEXT_UNKNOWN_TAX_RATE';
=======
>>>>>>> 36f4b1987c6e8834da26006d64c8efb30126c26f
