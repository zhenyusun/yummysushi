<?php
  define('HTTP_SERVER', 'http://www.yummysushi.dk'); // eg, http://localhost - should not be empty for productive servers
  define('HTTPS_SERVER', 'http://www.yummysushi.dk'); // eg, https://localhost - should not be empty for productive servers
  define('ENABLE_SSL', true); // secure webserver for checkout procedure?
  define('HTTP_COOKIE_DOMAIN', 'www.yummysushi.dk');
  define('HTTPS_COOKIE_DOMAIN', 'www.yummysushi.dk');
  define('HTTP_COOKIE_PATH', '');
  define('HTTPS_COOKIE_PATH', '');
  define('DIR_WS_HTTP_CATALOG', '');
  define('DIR_WS_HTTPS_CATALOG', '');
  define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
  define('DIR_WS_INCLUDES', 'include/');
  define('DIR_WS_IMAGES', DIR_WS_INCLUDES. 'images/');
  define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
  define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
  define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
  define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');

//Added for BTS1.0
  define('DIR_WS_TEMPLATES', 'templates/');
  define('DIR_WS_CONTENT', DIR_WS_TEMPLATES . 'content/');
  define('DIR_WS_JAVASCRIPT', DIR_WS_INCLUDES . 'js/');
//End BTS1.0
  define('DIR_WS_DOWNLOAD_PUBLIC', 'pub/');
  define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');
  define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG . 'pub/');

// define our database connection
  define('DB_SERVER', 'localhost'); // eg, localhost - should not be empty for productive servers
  define('DB_SERVER_USERNAME', 'bambooso_yummysushi');
  define('DB_SERVER_PASSWORD', '!234qwer');
  define('DB_DATABASE', 'bambooso_yummysushi');
  define('USE_PCONNECT', 'false'); // use persistent connections?
  define('STORE_SESSIONS', 'mysql'); // leave empty '' for default handler or set to 'mysql'
/*
  $dbConnString = "mysql:host=".DB_SERVER."; dbname=".DB_DATABASE;
  $pdoObj = new PDO($dbConnString, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
*/
?>
 
