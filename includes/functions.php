<?php 

/*
 *	functions.php
 *	
*/


/*
 *	called by index.php
 *	input: $_SESSION['CONTENT'] 
 *	loads the view file to be output
 */
function loadContent() 
{
	// initialise the variables
	$content = '';

	// check if content is set, else set default content
	if (isset($_SESSION['CONTENT']))
	{
		$content = $_SESSION['CONTENT'];
		$content = filter_var($content, FILTER_SANITIZE_STRING);
	}
	else
	{
		// Set up a default content page
		$content = 'default';
	}
	// Include the chosen page
	include (ROOT . '/view/' . $content . '.php');
}


/*
 *	called by most files/methods
 *	input: $trace_log (a string indicating where in the process the script is)
 *	output: print the trace_log string to the php_error console
 */
function writeTraceLog($trace_log)
{
	if (TRACE == "on")
	{
		error_log($trace_log);
	}
}
