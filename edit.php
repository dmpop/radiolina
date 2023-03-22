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
				<form style="margin-top: 2em;" action=" " method="POST">
					<label>Station
						<input class="card w-100" style="margin-bottom: 1.5em;" type="text" name="station">
					</label>
					<label>Stream URL
						<input class="card w-100" style="margin-bottom: 1.5em;" type="text" name="url">
					</label>
					<label>Logo URL
						<input class="card w-100" style="margin-bottom: 1.5em;" type="text" name="logo">
					</label>
					<div>
						<label>Station to remove
							<select class="card w-100" style="margin-bottom: 1.5em;" name="rmstation">
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
					<label>Password
						<input class="card w-100" style="margin-bottom: 2em;" type="password" name="password">
					</label>
					<button class="btn primary" title="Add station" type="submit" name="add"><img style='vertical-align: middle;' src='svg/add.svg' /></button>
					<button class="btn primary" title="Remove station" type="submit" name="remove"><img style='vertical-align: middle;' src='svg/remove.svg' /></button>
				</form>
				<button class="btn secondary" style="display: inline;" title="Back" onclick='window.location.href = "index.php"'><img style='vertical-align: middle;' src='svg/back.svg' /></button>
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
			</div>
			<div style="margin-bottom: 1em; margin-top: 1em;">
				<?php echo $footer; ?>
			</div>
		</div>
</body>

</html>