<?php
$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "weblogin";

$conn = mysqli_connect($serverName,$dBUsername,$dBPassword,$dBName);

if (!$conn){
	die("Database connect failed: " . mysqli_connect_error());
}