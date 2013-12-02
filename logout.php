<?php session_start();?>
<?php
$_SESSION = array(); // Clear the
session_destroy(); // Destroy the
setcookie('PHPSESSID', '', time()-3600,'/', '', 0, 0); // Destroy the cookie.
header('Location:login.php');
?>
