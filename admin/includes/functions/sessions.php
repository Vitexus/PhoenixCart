<?php
/*
  $Id$

  CE Phoenix, E-Commerce made Easy
  https://phoenixcart.org

  Copyright (c) 2021 Phoenix Cart

  Released under the GNU General Public License
*/

  /**
   * @deprecated since version 1.0.8.3
   */
  function tep_session_start() {
    return Session::start();
  }

  /**
   * @deprecated since version 1.0.8.3
   */
  function tep_session_destroy() {
    return Session::destroy();
  }
