<?php

$config = array();
define("BASE_URL", "http://localhost/userPage/");
$config['dbname'] = 'userPage';
$config['host'] = 'localhost';
$config['dbuser'] = 'root';
$config['dbpass'] = '';

global $db;
try {
	$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
} catch(PDOException $e) {
	echo "ERRO: ".$e->getMessage();
	exit;
}