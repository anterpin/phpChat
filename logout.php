<?php
session_start();
$_SESSION['logged'] = false;
header("Location:./login.php");


session_unset();
session_destroy();
exit;

?>
