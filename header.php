<?php
$server = "127.0.0.1";
$username = "pseudo";
$password = "password";
$dbname = "bdd";

$bdd = new PDO('mysql:host='.$server.';dbname='.$dbname.';charset=utf8', ''.$username.'', ''.$password.'');
?>