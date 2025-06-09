<!DOCTYPE html>
<html lang="en">
<?php require "partials/head.php" ?>
<body>
	<?php require("partials/nav_bar.php") ?>
	<main class="uploadPage">
		<div class="textInput">
			<textArea id="text" placeholder="your text here"></textArea>
			<button id="textBtn" type = "submit" class="defaultBtn">Submit Text</button>
		</div>

		<div class="voiceInput">
			<div class="recordings">
				<ul id="recordings" class="recorded"></ul>
			</div>
			<button type = "submit" class="defaultBtn">Submit Recordings </button>
		</div>
	</main>

	<?php require("partials/volume_bar.php") ?>
	</body>
</html>

