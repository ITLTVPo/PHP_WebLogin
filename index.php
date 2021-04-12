<?php
include_once 'header.php'
?>
		<h1>Index</h1>
		<?php
			if (isset($_SESSION["useruid"])){
				echo "<h1>Hello there " . $_SESSION["useruid"] ."</h1>";
			}
		?>
<?php
include_once 'footer.php'
?>

