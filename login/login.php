<?php
session_start();
//error_reporting(0);
//ini_set('display_errors', TRUE);
print "SESSION STARTED<br>";
if (version_compare(PHP_VERSION, '5.3.7', '<')) {
    exit("Sorry, Simple PHP Login does not run on a PHP version smaller than 5.3.7 !");
} else if (version_compare(PHP_VERSION, '5.5.0', '<')) {
    // if you are using PHP 5.3 or PHP 5.4 you have to include the password_api_compatibility_library.php
    // (this library adds the PHP 5.5 password hashing functions to older versions of PHP)
    require_once("libraries/password_compatibility_library.php");
}
print"VERSION CHECK COMPLETE<br>";
// include the configs / constants for the database connection
(require_once("../secure/dbcreds.php")) or die("Unable to access database ERR:1");
print "CREDS INCLUDED<br>";
// load the login class
(require_once("classes/Login.php")) or die("404 ERROR");
print "CLASS INCLUDED<br>";

//Perform login, and then read the result from the login.
$login = new Login();
print "LOGGED IN?<br>";

// print errors if applicable
if ($login->errors) {
    print "ERRORS<br>";
    $_SESSION['errors']=$login->errors;
     foreach ($login->errors as $error)
     {
        print $error . "<br>";
     }
}
if ($login->messages) {
    print"MESSAGES<br>";
    $_SESSION['messages']=$login->messages;
    foreach ($login->messages as $message)
    {
        print $message . "<br>";
    }
}
if($login->successful) {
    print "SUCCESSFUL<br>";
    //if(isset($_GET['ref'])) 
    //    {
    //    header("Location: " . htmlspecialchars($_GET['ref']));
    //    exit;
    //}
    header("Location: /");
    exit();
	//echo "<script>window.location='/'</script>";
}
else
{
    print "UNSUCCESSFUL<br>";
    header("Location: /login/index.php");
    exit();
	//echo "<script>window.location='/login/index.php'</script>";
}
print "<h1>IF YOU SEE THIS, EMAIL THE WEBMASTER IMMEDIATELY AT team327@gssm.k12.sc.us WITH THE SUBJECT, 'LOGIN FREEZE'.</h1>";