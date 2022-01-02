<?php
include('config.php');
?>

<!DOCTYPE html>
<html lang="en" data-theme="<?php echo $theme; ?>">

<!-- Author: Dmitri Popov, dmpop@linux.com
	 License: GPLv3 https://www.gnu.org/licenses/gpl-3.0.txt -->

<head>
	<title><?php echo $title; ?></title>
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
			<h1 style="display: inline; margin-top: 0em; vertical-align: middle; letter-spacing: 3px; color: #ffcc02;"><?php echo $title; ?></h1>
		</div>
		<hr style="margin-bottom: 2em;">
		<?php
		if (!file_exists($dir)) {
			mkdir($dir, 0750);
			$url = "http://stream.antenne.de/80er-kulthits";
			$logo = "http://www.antenne.de/assets/icons/antenne-de/apple-touch-icon.png?v=3";
			file_put_contents($dir . DIRECTORY_SEPARATOR . "Radio station 1", $url . PHP_EOL . $logo);
		}
		?>
		<form action=" " method="POST">
			<select name="station">
				<option value="--" selected>Select station</option>
				<?php
				$files = glob($dir . DIRECTORY_SEPARATOR . "*");
				foreach ($files as $file) {
					echo "<option value='" . $file . "'>" . pathinfo($file)['filename'] . "</option>";
				}
				?>
			</select>
			<button type='submit' role='button' name='stream'>Play</button>
			<button type="submit" value="Reload Page" onClick="window.location.reload(true)">Stop</button>
		</form>
		<?php
		if (isset($_POST['station'])) {
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
		<button style="margin-top: 1.5em; margin-bottom: 1.5em;" onclick='window.location.href = "edit.php"'>Edit</button>
		<div style="margin-bottom: 1em;">
			<?php echo $footer; ?>
		</div>
	</div>
</body>

</html>