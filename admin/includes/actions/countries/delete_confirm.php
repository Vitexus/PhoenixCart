<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2022 Phoenix Cart

  Released under the GNU General Public License
*/

  $country_id = Text::input($_GET['cID']);

  $db->query("DELETE FROM countries WHERE countries_id = " . (int)$country_id);

  return $link;
