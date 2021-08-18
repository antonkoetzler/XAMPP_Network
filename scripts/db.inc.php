<?php // Connects to 'user'
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'user';

$con = mysqli_connect($host, $user, $password, $db);

if (!$con)
	die ('Connection failed: '.mysqli_connect_error());
?>
