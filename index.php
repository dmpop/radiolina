<?php
include('config.php');
?>

<!DOCTYPE html>
<html lang="en" data-theme="<?php echo $theme; ?>">

<!-- Author: Dmitri Popov, dmpop@cameracode.coffee
	 License: GPLv3 https://www.gnu.org/licenses/gpl-3.0.txt -->

<head>
	<title><?php echo $title; ?></title>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="favicon.png" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="lit.css" />
	<!-- Suppress form re-submit prompt on refresh -->
	<script>
		if (window.history.replaceState) {
			window.history.replaceState(null, null, window.location.href);
		}
	</script>
</head>

<body>
	<div class="c">
		<div style="text-align: center;">
			<div class="card w-100">
				<img style="display: inline; height: 2.5em; vertical-align: middle;" src="favicon.svg" alt="logo" />
				<h1 style="display: inline; margin-top: 0em; vertical-align: middle; letter-spacing: 3px; color: #ce6a85;"><?php echo $title; ?></h1>
				<?php
				if (!file_exists($dir)) {
					mkdir($dir, 0750);
					$url = "http://stream.antenne.de/80er-kulthits";
					$logo = "http://www.antenne.de/assets/icons/antenne-de/apple-touch-icon.png?v=3";
					file_put_contents($dir . DIRECTORY_SEPARATOR . "Radio station 1", $url . PHP_EOL . $logo);
				}
				?>
				<form style="margin-top: 2em;" action=" " method="POST">
					<select class="card w-50" style="vertical-align: middle;" name="station">
						<option value="--" selected>Select station</option>
						<?php
						$files = glob($dir . DIRECTORY_SEPARATOR . "*");
						foreach ($files as $file) {
							echo "<option value='" . $file . "'>" . pathinfo($file)['filename'] . "</option>";
						}
						?>
					</select>
					<button class="btn primary" style="vertical-align: middle;" title="Stream the selected radio station" type='submit' name='play'><img style='vertical-align: middle;' src='svg/play.svg' /></button>
					<button class="btn primary" style="vertical-align: middle;" title="Stop streaming" type="submit" onClick="window.location.reload(true)"><img style='vertical-align: middle;' src='svg/stop.svg' /></button>
				</form>
				<?php
				if (isset($_POST['play'])) {
					$lines = file($_POST['station']);
					if (isset($lines[1])) {
						echo "<img style='margin-top: 1em; width:128px; max-width:100%; border-radius: 7px;' src='$lines[1]' />";
					} else {
						echo '<img style="margin-top: 1em;" src="audio.svg" />'; // Source: https://samherbert.net/svg-loaders/
					}
					echo "<h3 style='margin-top: 1em;'>" . pathinfo($_POST['station'])['filename'] . "</h3>";
					echo '<audio controls autoplay style="width: 100%; margin-top: 1em;"> <source src="' . $lines[0] . '">Audio tag is not supported in this browser.</audio></p>';
				}
				?>
				<button class="btn primary" title="Edit station list" style="margin-top: 1.5em; margin-bottom: 1.5em;" onclick='window.location.href = "edit.php"'><img style='vertical-align: middle;' src='svg/edit.svg' /></button>
			</div>
			<div style="margin-bottom: 1em;">
				<?php echo $footer; ?>
			</div>
		</div>
</body>

</html>