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
		<hr>
		<button title="Back" style="margin-top: 1.5em; margin-bottom: 1.5em;" onclick='window.location.href = "index.php"'><img style='vertical-align: middle;' src='svg/back.svg' /></button>
		<form class="text-left" action=" " method="POST">
			<label>Station:
				<input type="text" name="station">
			</label>
			<label>Stream URL:
				<input type="text" name="url">
			</label>
			<label>Logo URL:
				<input type="text" name="logo">
			</label>
			<div>
				<label>Station to remove:
					<select name="rmstation">
						<option value="--" selected>Select station</option>
						<?php
						$files = glob($dir . DIRECTORY_SEPARATOR . "*");
						foreach ($files as $file) {
							echo "<option value='" . $file . "'>" . pathinfo($file)['filename'] . "</option>";
						}
						?>
					</select>
				</label>
			</div>
			<label>Password:
				<input type="password" name="password">
			</label>
			<div class="text-center">
				<button title="Add station" type="submit" name="add"><img style='vertical-align: middle;' src='svg/add.svg' /></button>
				<button title="Remove station" type="submit" name="remove"><img style='vertical-align: middle;' src='svg/remove.svg' /></button>
			</div>
		</form>
		<?php
		if (isset($_POST['add']) && ($_POST['password'] == $password)) {
			file_put_contents($dir . DIRECTORY_SEPARATOR . $_POST['station'], $_POST['url'] . PHP_EOL . $_POST['logo']);
			echo "<script>";
			echo 'alert("' . $_POST['station'] . ' has been added.")';
			echo "</script>";
		}
		if (isset($_POST['remove']) && ($_POST['password'] == $password)) {
			unlink($_POST['rmstation']);
			echo "<script>";
			echo 'alert("' . pathinfo($_POST['rmstation'])['filename'] . ' has been removed.")';
			echo "</script>";
		}
		?>
		<div style="margin-bottom: 1em; margin-top: 1em;">
			<?php echo $footer; ?>
		</div>
	</div>
</body>

</html>