<?php

/*
 *	product_constants.php
 *	
*/


// log that the file has started
error_log("product_constants.php starts here ------->");


// CHANGELOG


// ABSTRACT
// Constants that are used in the gfs web app.
// e.g. The username and password for the DB.
// the salt constant that makes part of the fingerprint to secure sessions


// constants for the DB
DEFINE ('DB_USER', 'products_user');
DEFINE ('DB_PASSWORD', '123456789');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'products');
DEFINE ('DSN', 'mysql:host='.DB_HOST.';dbname='.DB_NAME);


// constants for sessions
DEFINE ('DEF_SALT', 'salt_hash_here');


// constants for include paths, needs to be validated for each server
// trailing slash added to keep the convention of just naming the folder/file.php when including
DEFINE ('ROOT', $_SERVER['DOCUMENT_ROOT'].'/octimine-php-test-2016');


// constants for tracing (writes lots of info to the php error_log file)
DEFINE ('TRACE', 'on'); // lowercase 'on' or 'off'


// constants for mysql error output (writes to the browser)
DEFINE ('SQL_ERRORS', 'on');

?>
