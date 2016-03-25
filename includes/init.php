<?php
/**
 *	init.php
 *	Initialisation file
 *	call the required constants file
 *	call the required functions file
 *	create the __autoload function to automatically load classes when they are called
 *	initialises the session
 *	@version    
 *	@copyright  
 */


// ABSTRACT
// This page is the initialisation file 
// It calls required constants, class and functions files


require_once('includes/private/product_constants.php');


// Initialise variables
$action = "";
$trace = true;
require_once(ROOT.'/includes/functions.php');


// start the trace log
writeTraceLog("init.php started here ------->");


// this function auto loads any called class from any file
function __autoload($class_name) 
{
	require_once(ROOT.'/includes/classes/class.'.strtolower($class_name).'.php');
}


// Initialise session
$session = new Session();

?>