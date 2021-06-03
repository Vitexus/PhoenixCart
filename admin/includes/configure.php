<?php
// set the level of error reporting
  error_reporting(E_ALL);

  const HTTP_SERVER = 'http://phoenix';
  const COOKIE_OPTIONS = [
    'lifetime' => 0, 
   'domain' => 'phoenix',
    'path' => '/admin',
    'samesite' => 'Lax',
  ];
  const DIR_WS_ADMIN = '/admin/';

  const DIR_FS_DOCUMENT_ROOT = '/home/vitex/Projects/PureHTML/PhoenixCart/';
  const DIR_FS_ADMIN = '/home/vitex/Projects/PureHTML/PhoenixCart/admin/';
  const DIR_FS_BACKUP = DIR_FS_ADMIN . 'backups/';

  const HTTP_CATALOG_SERVER = 'http://phoenix';
  const DIR_WS_CATALOG = '/';
  const DIR_FS_CATALOG = '/home/vitex/Projects/PureHTML/PhoenixCart/';

  date_default_timezone_set('Europe/Prague');

// If you are asked to provide configure.php details
// please remove the data below before sharing
  const DB_SERVER = 'localhost';
  const DB_SERVER_USERNAME = 'phoenix';
  const DB_SERVER_PASSWORD = 'phoenix';
  const DB_DATABASE = 'phoenix';
