<!DOCTYPE html>
<html lang="en">
<?php require "partials/head.php" ?>
<body>
	<?php require("partials/nav_bar.php") ?>
	<ul class="holder">
	<?php 
foreach($runs as $i => $run){
	$id = "/play?id=".$i;
	$title = implode(' ',array_slice($run,0,5));
	$length = "length: " . count($run) . " words";
	require("partials/run.php");
}
	?>
	</ul>
	<?php require("partials/volume_bar.php") ?>
</body>
</html>

