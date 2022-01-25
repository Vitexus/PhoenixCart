<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  require 'includes/application_top.php';

  $hooks->register_pipeline('loginRequired');
  $hooks->cat('injectRedirect');

  $port_my_data = [];
  $hooks->cat('injectData');

  require language::map_to_translation('gdpr.php');

  require $Template->map(__FILE__, 'page');

  require 'includes/application_bottom.php';
