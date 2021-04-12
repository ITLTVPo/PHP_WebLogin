<?php
if(isset($_POST["submit"])){
	$name = $_POST["name"];
	$email = $_POST["email"];
	$uid = $_POST["uid"];
	$pwd = $_POST["pwd"];
	$pwd2 = $_POST["pwd2"];

	require_once 'dbh.inc.php';
	require_once 'function.inc.php';

	if (emptyInputSignup($name,$email,$uid,$pwd,$pwd2) !== false){
		header("location: ../signup.php?error=missingValue");
		exit();
	}
	if (invalidUidSignup($uid) !== false){
		header("location: ../signup.php?error=invalidUid");
		exit();
	}
	if (invalidEmail($email) !== false){
		header("location: ../signup.php?error=invalidEmail");
		exit();
	}
	if (existsUid($conn, $uid, $email) !== false){
		header("location: ../signup.php?error=existsUid");
		exit();
	}
	if (pwdmismatch($pwd,$pwd2) !== false){
		header("location: ../signup.php?error=pswmismatch");
		exit();
	}
	createUser($conn, $name,$email,$uid,$pwd);
}

else{
	header("location: ../signup.php");
	exit();
}