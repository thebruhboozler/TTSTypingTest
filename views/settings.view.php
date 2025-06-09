<!DOCTYPE html>
<html lang="en">
<?php require "partials/head.php" ?>
<body>
	<?php require("partials/nav_bar.php") ?>
	<main class="mainPage">
		<!-- es rom ara yvelaferi daubureba -->
		<div class="mainPageBackground"></div>
		<form method="post" action="/changeSettings" class="defaultForm" id="changeForm">
			
			<input type="text" name="username" placeholder="username" class="defaultInput" required/>
			<input type="text" name="username" placeholder="email" class="defaultInput" required/>
			<input type="password" name="password" placeholder="password" class="defaultInput" required/>
			<input type="password" name="password" placeholder="new password" class="defaultInput" required/>
			<input type="password" placeholder="repeat new password" class="defaultInput" required/>
			

			<button type="submit" id="loginBtn" class="defaultBtn largeBtn">confirm changes</button>
		</form>
	</main>

	<?php require("partials/volume_bar.php") ?>
	</body>
</html>

