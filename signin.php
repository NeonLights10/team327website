<?php


if(htmlspecialchars($_GET['ref'])=="seek") 
{
    header("Location: login/?ref=seek.php");
    exit;
}
elseif(htmlspecialchars ($_GET['ref'])=="offer")
{
    header("Location: login/?ref=offer.php");
    exit;
}
else 
{
    header("Location: login/");
    exit;
}

?>