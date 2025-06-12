<!DOCTYPE html>
<html lang="en">
<?php require "partials/head.php" ?>
<body>
	<main class="mainPage">
		<!-- es rom ara yvelaferi daubureba -->
		<div class="mainPageBackground"></div>
		<h2 class = "pageTitle">TTStypingTest</h2>
		<form method="post" action="/login" class="defaultForm" id="loginForm">
			<input type="text" name="emailOrUsername" placeholder="email/username" class="defaultInput"/>
			<input type="password" name="password" placeholder="password" class="defaultInput"/>
			<div class="signUpLogInDiv">
				<button type="submit" id="loginBtn" class="defaultBtn"> Log in</button>
				<a href="/signup" id="signUpBtn" class="defaultBtn">Sign up</a>
			</div>
			<button type="button" id="guestBtn" class="defaultBtn largeBtn">continue as guest</button>
		</form>
		<p class="description">
 		TTstypingTest stands for text-to-speech typing test. Unlike other typing tests , instead of reading the words they will be read out to you , the faster you type the faster the tts will go.  In TTStypingTest there are many runs to chose from , every run is created by our users and you can create your own runs as well.  if you find any issues with a run , be sure to report it and our admins will examine it. 
		</p>
	</main>

</body>
</html>

