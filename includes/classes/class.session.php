<?php
/**
 * class.sessions.php
 * the functions necessary to get and check sessions
 * version 1.0
 */


/**
 *	VARIABLES
 * change the session time here (in seconds)
 */
const SESSION_LENGTH = '3600'; // 60 minutes


/**
 *	make changes to the php.ini file regarding sessions
 *	change the php server ini file to use whirlpool when making session IDs.
 *	change the php server ini file to read the session cookie only via http
 *	(means the server will only listen to http, and not scripting languages)
 */

ini_set('session.hash_function', 'whirlpool');
ini_set('session.cookie_httponly', '1');
ini_set('session.cookie_path', '/');

// starts new or resumes existing session
session_start();

class Session
{	
	/**	
	 *	This function validates the fingerprint
	 *	recreate the elements that make the $password
	 *	pass $password to the pbkdf2 function validate_password
	 *	if false, destroy session and cookies
	 *	return false
	 *	if valid, returns true
	 */
	public function validateFingerprint()
	{
		$challenge = Encryption::validate_password(DEF_SALT.$_SERVER['HTTP_USER_AGENT'], PBKDF2_HASH_ALGORITHM.":".PBKDF2_ITERATIONS.":".$_SESSION['FINGERPRINT']);
		if (!$challenge)
		{
			$this->destroySession();
			$this->destroyCookie();
			echo "<p style='color:red'>Challenge failed: session fingerprints don't match<br />";
			return false;
		}
		else
		{
			return true;
		}
	}
	

	/**	
	 *	check if 'fingerprint' is set
	 *	if fingerprint is set, validate it
	 *	if fingerprint is not set, make it
	 */
	function validateOrSetFingerprint()
	{
		if (isset($_SESSION['FINGERPRINT']))
		{
			$challenge = $this->validateFingerprint();
			if (!$challenge)
			{
				die("Security issue detected. You have been logged out. (error 1)");
			}
			else
			{
				return true;
			}
		}
		else
		{
			$this->makeFingerprint();
			return true;
		}
	}
	
	
	/**	
	 *	This function checks that a fingerprint is set AND valid
	 *	otherwise it dies
	 */
	function validateFingerprintOrDie()
	{
		if (isset($_SESSION['FINGERPRINT']))
		{
			$challenge = $this->validateFingerprint();
			if (!$challenge)
			{
				$this->listSessionInfo();
				//$this->listCookieInfo();
				die("Security issue detected. You have been logged out. (error 2)");
			}
			else
			{
				return true;
			}
		}
		else
		{
			$this->destroyCookie();
			$this->destroySession();
			$this->listSessionInfo();
			//$this->listCookieInfo();
			die("Security issue detected. You have been logged out. (error 3)");
		}
	}
	
	
	/**	
	 *	to make fingerprint, 
	 *	take a defined constant, combine with the user agent and convert it into a hash
	 *	remove the first 2 bits of information, 
	 *	the constants PBKDF2_HASH_ALGORITHM.":".PBKDF2_ITERATIONS. (sha256:1000:)
	 *	store this code in the $_SESSION array
	 *	in production, change fingerprint to fp
	 *	set a cookie. note that the first argument is the name the cookie should have
	 */	
	public static function makeFingerPrint()
	{
		$hashed_user_agent = Encryption::create_hash(DEF_SALT.$_SERVER['HTTP_USER_AGENT']);
		$params_array = explode(":", $hashed_user_agent);
		$_SESSION['FINGERPRINT'] = $params_array['2'].":".$params_array['3'];
	}


	/**
	 * destroys sessions
	 */
	public static function destroySession()
	{
		unset($_SESSION['FINGERPRINT']);
		session_unset();
		session_destroy();
		writeTraceLog("destroySession()... sessions have been destroyed...");
	}


	/**
	 * destroys cookies
	 */
	public static function destroyCookie()
	{
		unset($_COOKIE['webID']);
		// have the browser remove the cookie by setting a bad time
		setcookie(session_name(), "", time()-42000, '/');
	}
	

	// for debugging
	public static function listSessionInfo()
	{
		$sessionInfo = "Session array:<br />";
		foreach ($_SESSION as $key => $value)
		{
			$sessionInfo .= "&nbsp;&nbsp;&nbsp;&nbsp;[".$key."]"." => ".$value."<br />";
		}
		return $sessionInfo;
	}
	

	// for debugging
	public static function listCookieInfo()
	{
		$cookieInfo = "Cookie array:<br />";
		foreach ($_COOKIE as $key => $value)
		{
			$cookieInfo .= "&nbsp;&nbsp;&nbsp;&nbsp;[".$key."]"." => ".$value."<br />";
		}
		return $cookieInfo;
	}


	/**
	 *	Adds a session warning (appears under the form element that has an error)
	 *	Called by the range of processForm functions
	 */
	static public function addSessionWarning($warning)
	{
		if (isset($_SESSION['WARNING']))
		{
			$_SESSION['WARNING'] .= "<br />".htmlentities($warning);
		}
		else
		{
			$_SESSION['WARNING'] = htmlentities($warning);
		}
	}


	/**
	 *	Adds a general session warning (appears at the top of forms when there's an error)
	 *	Called by the range of processForm functions
	 */
	static public function addSessionGeneralWarning($warning)
	{
		if (isset($_SESSION['GENERAL_WARNING']))
		{
			$_SESSION['GENERAL_WARNING'] .= htmlentities($warning);
		}
		else
		{
			$_SESSION['GENERAL_WARNING'] = htmlentities($warning);
		}
	}


	/**
	 *	Sets the form element that is to be targeted by the session warning
	 *	Called by the range of processForm functions
	 */
	static public function addElementWarning($element)
	{
		$_SESSION['TARGET_ELEMENT'] = $element;
	}


	/**	
	 *	This function checks the Post and Session Fingerprints match
	 *	does not increment user's login attempts
	 */
	static public function comparePostandSessionFingerprints()
	{
		writeTraceLog("comparePostandSessionFingerprints() starts here ------->");
		if (!isset($_POST['post_fingerprint']) || !isset($_SESSION['FINGERPRINT'])) 
		{
			writeTraceLog("comparePostandSessionFingerprints(): something not set".$_POST['post_fingerprint']);
			$warning = "Sorry, there was a security issue. Please refresh this page and start again. (error 4) ";
			self::addSessionGeneralWarning($warning);
			return false;
		}
		else if ($_POST['post_fingerprint'] != $_SESSION['FINGERPRINT']) 
		{
			writeTraceLog("comparePostandSessionFingerprints(): don't match");
			$warning = "Sorry, there was a security issue. Please refresh this page and start again. (error 5) ";
			self::addSessionGeneralWarning($warning);
			return false;
		}
		else
		{
			return true;
		}
	}


	/**	
	 *	This function checks the Post and Session Fingerprints match
	 *	and if they don't, then it increments the user's login attempts
	 */
	static public function comparePostandSessionFingerprintsAndIncrement()
	{
		writeTraceLog("comparePostandSessionFingerprints() starts here ------->");
		if (!isset($_POST['post_fingerprint']) || !isset($_SESSION['FINGERPRINT'])) 
		{
			writeTraceLog("comparePostandSessionFingerprints(): something not set");
			$warning = "Sorry, there was a security issue. Please refresh this page and start again. (error 6) ";
			user::incrementLoginAttempts();
			self::addSessionGeneralWarning($warning);
			return false;
		}
		else if ($_POST['post_fingerprint'] != $_SESSION['FINGERPRINT']) 
		{
			writeTraceLog("comparePostandSessionFingerprints(): don't match");
			$warning = "Sorry, there was a security issue. Please refresh this page and start again. (error 7) ";
			user::incrementLoginAttempts();
			self::addSessionGeneralWarning($warning);
			return false;
		}
		else
		{
			return true;
		}
	}


}
?>