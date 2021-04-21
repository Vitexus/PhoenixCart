<?php
/*
  $Id: zones.php,v 1.3 2002/11/19 01:48:08 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

const MODULE_SHIPPING_ZONES_TEXT_TITLE = 'Zóny (Zone Based Shipping Rates)';
const MODULE_SHIPPING_ZONES_TEXT_DESCRIPTION = 'Modul umožǔje nastavit různou výši poštovného pro několik zón, definovaných jako seznam zemí. Poštovné se počítá na základě váhy nebo ceny.';
const MODULE_SHIPPING_ZONES_TEXT_WAY = 'Ground';
const MODULE_SHIPPING_ZONES_TEXT_UNITS = 'kg';
const MODULE_SHIPPING_ZONES_INVALID_ZONE = 'Do dané země nelze dodat';
const MODULE_SHIPPING_ZONES_UNDEFINED_RATE = 'Cenu dopravy nelze vypočítat';
//pure:new module internationalisation
const CONFIG_TITLE_MODULE_SHIPPING_ZONES_MODE = 'Tabulka ';
define('CONFIG_DESCRIPTION_MODULE_SHIPPING_ZONES_MODE','
Náklady na dopravu jsou počítány na základě celkové objednávky nebo celkové hmotnosti objednaného zboží.
Vyplňte tabulku dopravného pro různé skupiny zemí, v poslední skupině ponechte pole "Zóna N - země" prázdnou - příslušná Tabulka poštovného se použije pro všechny ostatní země .
');
const CONFIG_TITLE_NUM_ZONES = 'Počet zón';
const CONFIG_DESCRIPTION_NUM_ZONES = 'Zadejte počet zón (max. 10), uložte a znovu editujte, teprve tehdy se objeví nové zóny.';

const CONFIG_TITLE_MODULE_SHIPPING_ZONES_TAX_CLASS = 'Sazba DPH';
const CONFIG_DESCRIPTION_MODULE_SHIPPING_ZONES_TAX_CLASS = 'Zvolte sazbu DPH pro poštovné. Pokud používáte Českou poštu - nastavte 0% (je osvobozena od DPH).';

const CONFIG_TITLE_MODULE_SHIPPING_ZONES_SORT_ORDER = 'Pořadí';
const CONFIG_DESCRIPTION_MODULE_SHIPPING_ZONES_SORT_ORDER = 'Pořadí zobrazení.';

const CONFIG_TITLE_MODULE_SHIPPING_ZONES_STATUS = 'Povolit modul Zóny?';
const CONFIG_DESCRIPTION_MODULE_SHIPPING_ZONES_STATUS = 'Chcete povolit výpočet dopravného podle zón?';

