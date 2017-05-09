<?php

if(isset($_SESSION["time"]))
{
    if(time()-$_SESSION["time"]>time()-30*60) {
        $_SESSION = array();
        session_destroy();
    }
}
$_SESSION["time"] = time();

