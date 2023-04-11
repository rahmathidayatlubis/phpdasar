<?php

session_start();
$_SESSION = [];
session_unset();
session_destroy();


setcookie('key1', '', time()-3600);
setcookie('key2', '', time()-3600);


header("Location: login.php");
exit;


?>