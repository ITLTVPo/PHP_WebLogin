<?php
function emptyInputSignup($name,$email,$uid,$pwd,$pwd2){
	$result;
	if((empty($name) || empty($email) || empty($uid) || empty($pwd) || empty($pwd2)) !== false){
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;
}
function invalidUidSignup($uid){
	$result;
	if(!preg_match("/^[a-zA-Z0-9]*$/",$uid)){
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;
}
function invalidEmail($email){
	$result;
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;
}


function pwdmismatch($pwd,$pwd2){
	$result;
	if($pwd !== $pwd2){
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;
}

function existsUid($conn, $uid, $email){
	$sql = "SELECT * FROM users WHERE usersUid = ? OR usersEmail = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)){
		header("location: ../signup.php?error=stmtfailed");
		exit();
	}
	mysqli_stmt_bind_param($stmt,"ss",$uid,$email);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
	if($row = mysqli_fetch_assoc($result)){
		return $row;
	}
	else{
		$result = false;
		return $result;
	}
	mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $email, $uid, $pwd){
	$sql = "INSERT INTO users (usersName, usersEmail, usersUid, usersPwd) VALUES (?,?,?,?);";
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt,$sql)){
		header("location: ../signup.php?error=stmtfailed");
		exit();
	}
	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
	mysqli_stmt_bind_param($stmt,"ssss",$name,$email, $uid, $hashedPwd);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	header("location: ../signup.php?error=none");
}

function emptyInputLogin($uid,$pwd){
	$result;
	if ((empty($uid) || empty($pwd)) !== false){
		$result = true;
	}
	else{
		$result = false;
	}
	return $result;
}

function loginUser($conn, $uid, $pwd){
	$user = existsUid($conn, $uid, $uid);
	if ($user === false){
		header("location: ../login.php?error=wronglogin");
		exit();
		}
	$pwd_hash = $user[usersPwd];
	$check_pwd = password_verify($pwd,$pwd_hash);
	if ($check_pwd === false){
		header("location: ../login.php?error=wronglogin1");
		exit();
	}
	else if($check_pwd === true){
	// else{
		session_start();
		$_SESSION["userid"]=$existsUid["usersId"];
		$_SESSION["useruid"]=$existsUid["usersUid"];
		header("location: ../index.php");
		exit();
	}
}