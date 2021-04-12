<?php
	include_once 'header.php'
?>

<form action='./include/login.inc.php' method='POST'>
	<input type='text' name='uid' placeholder="Your username or Email"/>
	<input type='password' name='pwd' placeholder="Your password"/>
	<button type='submit' name='submit'>Login</button>
</form>

<?php
	if(isset($_GET['error'])){
		// if($_GET['error'] == )
	}
?>

<?php
	include_once 'footer.php'
?>