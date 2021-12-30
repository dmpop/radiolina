<?php
$theme = "dark";
$title = "Radio";
$footer = "I really 🧡 <a href='https://www.paypal.com/paypalme/dmpop'>coffee</a>";
?>
<!DOCTYPE html>
<html lang="en" data-theme="<?php echo $theme; ?>">

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
			<h1 style="display: inline; margin-top: 0em; vertical-align: middle; letter-spacing: 3px;"><?php echo $title; ?></h1>
		</div>
		<hr style="margin-bottom: 2em;">
		<?php
		$dir = "stations";
		if (!file_exists($dir)) {
			mkdir($dir, 0777, true);
		}
		?>
		<form action=" " method="POST">
			<select name="station">
				<option value="--" selected>Select station</option>
				<?php
				$files = glob($dir . "/*");
				foreach ($files as $file) {
					$name = pathinfo($file)['extension'];
					echo "<option value='" . $file . "'>" . pathinfo($file)['filename'] . "</option>";
				}
				?>
			</select>
			<button type='submit' role='button' name='stream'>Play</button>
			<button type="submit" value="Reload Page" onClick="window.location.reload(true)">Stop</button>
		</form>
		<?php
		if (isset($_POST['station'])) {
			$url = file_get_contents($_POST['station']);
			echo '<img style="margin-top: 1em;" src="audio.svg" />'; // Source: https://samherbert.net/svg-loaders/
			echo "<h3 style='margin-top: 1em;'>" . pathinfo($_POST['station'])['filename'] . "</h3>";
			echo '<audio controls autoplay style="width: 100%; margin-top: 1em;"> <source src="' . $url . '">Audio tag is not supported in this browser.</audio></p>';
		}
		?>
		<ol>
			<li>
				Choose the desired station and press <strong>Play</strong>.
			</li>
			<li>
				Use playback controls to start and pause streaming.
			</li>
			<li>
				Press <strong>Stop</strong> to stop the radio.
			</li>
		</ol>
	</div>
	<div class="text-center">
		<?php echo $footer; ?>
	</div>
</body>

</html>