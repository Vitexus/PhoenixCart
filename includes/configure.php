<?php
// set the level of error reporting
  error_reporting(E_ALL);

  const HTTP_SERVER = 'http://phoenix';
  const COOKIE_OPTIONS = [
    'lifetime' => 0,
    'domain' => 'phoenix',
    'path' => '/',
    'samesite' => 'Lax',
  ];
  const DIR_WS_CATALOG = '/';

  const DIR_FS_CATALOG = '/home/vitex/Projects/PureHTML/PhoenixCart/';

  date_default_timezone_set('Europe/Prague');

// If you are asked to provide configure.php details
// please remove the data below before sharing
  const DB_SERVER = 'localhost';
  const DB_SERVER_USERNAME = 'phoenix';
  const DB_SERVER_PASSWORD = 'phoenix';
  const DB_DATABASE = 'phoenix';
