<!DOCTYPE html>
<html lang="en" data-theme="dark">

<!-- Author: Dmitri Popov, dmpop@linux.com
	 License: GPLv3 https://www.gnu.org/licenses/gpl-3.0.txt -->

<head>
	<title>Radio</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="favicon.png" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/classless.css" />
	<link rel="stylesheet" href="css/themes.css" />
	<!-- Suppress form re-submit prompt on refresh -->
	<script>
		if (window.history.replaceState) {
			window.history.replaceState(null, null, window.location.href);
		}
	</script>
</head>

<body>
	<div class="card text-center">
		<div style="margin-top: 1em; margin-bottom: 1em;">
			<img style="display: inline; height: 2.5em; vertical-align: middle;" src="favicon.svg" alt="logo" />
			<h1 style="display: inline; margin-top: 0em; vertical-align: middle; letter-spacing: 3px; color: #e68a00;">Radio</h1>
		</div>
		<hr style="margin-bottom: 2em;">
		<?php
		$dir = "stations";
		if (!file_exists($dir)) {
			mkdir($dir, 0777, true);
		}
		?>
		<form action=" " method="POST">
			<label for='weight'>Station:</label>
			<select name="station">
				<option value="default" selected>Select station</option>
				<?php
				$files = glob($dir . "/*");
				foreach ($files as $file) {
					$filename = basename($file);
					$name = pathinfo($file)['extension'];
					echo "<option value='" . file_get_contents($file) . "'>" . pathinfo($file)['filename'] . "</option>";
				}
				?>
			</select>
			<button type='submit' role='button' name='stream'>Select</button>
		</form>
		<?php
		if (isset($_POST['station'])) {
			echo '<audio style="width: 100%; margin-top: 2em;" src="' . $_POST['station'] . '" controls="true" volume="1.0"></audio></p>';
		}
		?>
		<ol>
			<li>
				Choose the desired station and press <strong>Select</strong>.
			</li>
			<li>
				Use playback controls to start and stop streaming.
			</li>
		</ol>
	</div>
</body>

</html>