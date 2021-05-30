<?php
// set the level of error reporting
  error_reporting(E_ALL);

  const HTTP_SERVER = 'http://ph.local';
  const COOKIE_OPTIONS = [
    'lifetime' => 0,
    'domain' => 'ph.local',
    'path' => '/admin',
    'samesite' => 'Lax',
  ];
  const DIR_WS_ADMIN = '/admin/';

  const DIR_FS_DOCUMENT_ROOT = '/home/f/git/PhoenixCart/';
  const DIR_FS_ADMIN = '/home/f/git/PhoenixCart/admin/';
  const DIR_FS_BACKUP = DIR_FS_ADMIN . 'backups/';

  const HTTP_CATALOG_SERVER = 'http://ph.local';
  const DIR_WS_CATALOG = '/';
  const DIR_FS_CATALOG = '/home/f/git/PhoenixCart/';

  date_default_timezone_set('Europe/Prague');

// If you are asked to provide configure.php details
// please remove the data below before sharing
  const DB_SERVER = 'localhost';
  const DB_SERVER_USERNAME = 'ph';
  const DB_SERVER_PASSWORD = 'ph';
  const DB_DATABASE = 'PhoenixCart';
