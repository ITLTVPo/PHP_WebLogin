<?php
include_once 'header.php'
?>
	<h1>Sign Up here...</h1>
	<form action="./include/signup.inc.php" method="post">
		<input type="text" name="name" placeholder="Your fullname..."/>
		<input type="text" name="email" placeholder="Your email..."/>
		<input type="text" name="uid" placeholder="Your username..."/>
		<input type="password" name="pwd" placeholder="Your password..."/>
		<input type="password" name="pwd2" placeholder="Confirm your password..."/>
		<button type="submit" name="submit">Submit</button>
	</form>
<?php
include_once 'footer.php'
?>