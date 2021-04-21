<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
 */

const NAVBAR_TITLE_1 = 'Pokročilé vyhledávání';
const NAVBAR_TITLE_2 = 'Výsledky vyhledávání';

const HEADING_TITLE_1 = 'Pokročilé vyhledávání';
const HEADING_TITLE_2 = 'Výsledky vyhledávání';

const HEADING_SEARCH_CRITERIA = 'Vyhledávací kritéria';

const TEXT_SEARCH_IN_DESCRIPTION = 'Vyhledávání v popisu produktů';
const ENTRY_CATEGORIES = 'Kategorie:';
const ENTRY_INCLUDE_SUBCATEGORIES = 'Včetně podkategorií';
const ENTRY_MANUFACTURERS = 'Výrobci:';
const ENTRY_PRICE_FROM = 'Cena od:';
const ENTRY_PRICE_TO = 'Cena do:';
const ENTRY_DATE_FROM = 'Datum přidání od:';
const ENTRY_DATE_TO = 'Datum přidání do:';

define('TEXT_SEARCH_HELP_LINK',
    '<span class="glyphicon glyphicon-info-sign"></span> Pomoc s vyhledáváním',
    true);

const TEXT_ALL_CATEGORIES = 'Všechny kategorie';
const TEXT_ALL_MANUFACTURERS = 'Všichni výrobci';

const HEADING_SEARCH_HELP = 'Pomoc s vyhledáváním';
const TEXT_SEARCH_HELP = '';
//    'Klíčová slova můžete oddělovat AND a/nebo OR pro lepší výsledky.<br /><br />For example, <u>Microsoft AND mouse</u> would generate a result set that contain both words. However, for <u>mouse OR keyboard</u>, the result set returned would contain both or either words.<br /><br />Exact matches can be searched for by enclosing keywords in double-quotes.<br /><br />For example, <u>"notebook computer"</u> would generate a result set which match the exact string.<br /><br />Brackets can be used for further c.<br /><br />For example, <u>Microsoft and (keyboard or mouse or "visual basic")</u>.',    true);
const TEXT_CLOSE_WINDOW = '<u>zavřít okno</u> [x]';

define('TEXT_NO_PRODUCTS',
    'Produkt dle zadaných kritérí nebyl nalezen. Zkuste upravit vyhledávací dotaz.',
    true);

const ERROR_AT_LEAST_ONE_INPUT = 'Musíte vyplnit jedno z polí.';
const ERROR_INVALID_FROM_DATE = 'špatně datum Od.';
const ERROR_INVALID_TO_DATE = 'špatně datum Do.';
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE',
    'Datum Do musí být vyšší než datum Od.');
const ERROR_PRICE_FROM_MUST_BE_NUM = 'cena Od musí být číslo.';
const ERROR_PRICE_TO_MUST_BE_NUM = 'cena musí být číslo.';
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM',
    'cena Do musí být vyšší než cena Od.');
const ERROR_INVALID_KEYWORDS = 'špatné klíčové slovo.';
//pure:new
const IMAGE_BUTTON_BACK_ADVANCED_SEARCH = 'zpět na podrobné vyhledávání';
?>
