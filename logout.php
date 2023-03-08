<?php

session_start();
$_SESSION['login'];
$_SESSION = [];
session_unset();
session_destroy();

header("location: index.php");
exit;

?>