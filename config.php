<?php
$host = 'localhost';
$username = 'root';
$password = 'qingtian1';
$database = 'book_manage';

$dbc = mysqli_connect($host,$username,$password,$database);
if(!$dbc)
	die("<h1>failed to connect mysql!</h1>");
echo "successed to connect mysql!<br />"

?>