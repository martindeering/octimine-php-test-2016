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



/*
 *	called by PDO error
 *	output: print the trace_log string to the php_error console
 *	TURN OFF when in production
 */

function handle_sql_errors($query, $error_message)
{
    if ( SQL_ERRORS == "on" )
    {
		echo '
		<div class="panel panel-danger">
			<div class="panel-heading">
				<h3 class="panel-title">Database Error!</h3>
			</div>
			<div class="panel-body">The server ran into an error. Sorry!<br />
			'.$query.'<br /></div>
		</div>
		';
		return;
	} else {
		die;
	}
}