<?php require_once('api.php'); ?>
<!DOCTPYE html>
<html>
	<head>
		<title>HB Anipicker</title>
		<link rel="stylesheet" href="style.css" />
	</head>
	<body>
		<div class="header">
			<h1 class="center huge text">Hummingbird Anipicker!</h1>
			<form class="align center form" action="index.php" method="get">
				<input type="text" name="user" value="<?php echo $_GET['user'] ?>" autofocus  placeholder="Type your HB username and press Enter!" />
				<input type="checkbox" name="force-to-watch" value="true" <?php echo $_GET['force-to-watch'] ? "checked" : "" ?> /><label>Force to Watch</label>
			</form>
			<br />
		</div>
		<div class="body">
			<?php 
				if(getAPI($_GET['user']) == false) {
					echo '<h1 class="big text center">No Username Filled in</h1>';
				} else {
					getRandomAnime();
				}
			?>
		</div>
	</body>
</html>