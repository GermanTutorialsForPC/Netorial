<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
define('DB_HOST', 'Database Host (e.g. localhost)');
define('DB_NAME', 'Database Name (e.g. netorial)');
define('DB_USERNAME', 'Database Username (e.g. root)');
define('DB_PASS', 'Database Password (e.g. pass)');


mysql_connect(DB_HOST, DB_USERNAME, DB_PASS) or die("Fehler bei der Verbindung mit der Datenbank.");
mysql_select_db(DB_NAME);
?>