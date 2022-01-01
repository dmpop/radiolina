<?php
include('config.php');
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
		<hr>
		<button style="margin-top: 1.5em; margin-bottom: 1.5em;" onclick='window.location.href = "index.php"'>Back</button>
		<form class="text-left" action=" " method="POST">
			<label for="station">Station:</label>
			<input type="text" name="station" value="">
			<label for="url">URL:</label>
			<input type="text" name="url" value="">
			<label for="logo">Logo:</label>
			<input type="text" name="logo" value="">
			<label for="password">Password:</label>
			<input type="password" name="password" value="">
			<div class="text-center">
				<button type="submit" name="add">Add</button>
				<button type="submit" name="delete">Delete</button>
			</div>
		</form>
		<?php
		$dir = "stations/";
		if (isset($_POST['add']) && ($_POST['password'] = $password)) {
			file_put_contents($dir . $_POST['station'], $_POST['url'] . PHP_EOL . $_POST['logo']);
			echo "Station <em>" . $_POST['station'] . "</em> has been added.";
		}
		if (isset($_POST['delete']) && ($_POST['password'] = $password)) {
			unlink($dir . $_POST['station']);
			echo "Station <em>" . $_POST['station'] . "</em> has been deleted.";
		}
		?>
		<div style="margin-bottom: 1em; margin-top: 1em;">
			<?php echo $footer; ?>
		</div>
	</div>
</body>

</html>