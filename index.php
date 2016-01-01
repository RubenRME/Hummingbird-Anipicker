<?php require_once('api.php'); ?>
<!DOCTPYE html>
<html>
	<head>
		<title>HB Anipicker | RME</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
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
					if(!isset($_GET['user'])) {
						echo '<h1 class="big text center">No Username Filled in</h1>';
					}else{
						echo '<h1 class="big text center">Unexisting username</h1>';
						echo '<h2 class="medium text center">Hummingbird responds with error 404</h2>';
					}
				} else {
					getRandomAnime();
				}
			?>
		</div>
	</body>
</html>