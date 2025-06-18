<!DOCTYPE html>
<html lang="en">
<head>
<?php require("./views/partials/head.php") ?>
</head>
<body>
	<main class="mainPage">
		<!-- es rom ara yvelaferi daubureba -->
		<div class="mainPageBackground"></div>
		<h2 class = "pageTitle">TTStypingTest</h2>
		<form method="post" action="/signup" class="defaultForm" id="signUpForm">
			
			<input type="text" name="username" placeholder="username" id="username" class="defaultInput"/>
			<input type="email" name="email" placeholder="email" class="defaultInput"/>
			<input type="password" name="password" id="password" placeholder="password" class="defaultInput"/>
			<input type="password" placeholder="repeat password" id="repeatPassword" class="defaultInput"/>
			
			<button type="submit" id="loginBtn" class="defaultBtn largeBtn">Sign up</button>
		</form>
	</main>

</body>
</html>

