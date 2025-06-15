<!DOCTYPE html>
<html lang="en">
<?php require "partials/head.php" ?>
<body>
	<?php require("partials/nav_bar.php") ?>
	<main class="mainPage playArea">
		<!-- es rom ara yvelaferi daubureba -->
		<div class="mainPageBackground"></div>
		<p id="stopwatch" class="stopwatch"> 0:00</p>
		<p id = "playArea" class="playText">get ready to type!</p>
		<div class="btnHolder" id="btnMenu">
			<img id="home" src="./views/assets/regular-house.svg"/>
			<img id="next" src="./views/assets/icon-next.svg"/>
			<img id="retry"src="./views/assets/icons-retry.svg"/>
		</div>
		<audio id="player"/>
	</main>

	<?php require("partials/volume_bar.php") ?>
	</body>
</html>

