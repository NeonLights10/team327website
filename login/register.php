<?php
session_start();
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
// load the registration class
(require_once("classes/Registration.php")) or die("404 ERROR");
print "CLASS INCLUDED<br>";
// create the registration object. when this object is created, it will do all registration stuff automatically
// so this single line handles the entire registration process.
$registration = new Registration();
print "REGISTERED<br>";
// show potential errors / feedback (from registration object)
if ($registration->errors) {
    print "ERRORS<br>";
    $_SESSION['errors']=$registration->errors;
     foreach ($registration->errors as $error)
     {
        print $error . "<br>";
     }
}
if ($registration->messages) {
    print"MESSAGES<br>";
    $_SESSION['messages']=$registration->messages;
    foreach ($registration->messages as $message)
    {
        print $message . "<br>";
    }
}
if($registration->successful) {
    print "SUCCESSFUL<br>";
    //if(isset($_GET['ref'])) 
    //    {
    //    header("Location: ../" . htmlspecialchars($_GET['ref']));
    //    exit;
    //}
    header("Location: /index.php");
	//echo "<script>window.location='/'</script>";
    exit();
}
else
{
    print "UNSUCCESSFUL<br>";
    header("Location: /login/index.php");
    exit();
}