<?php

// Get rid of stupid errors when GET is not set
if(!isset($_GET['user'])) { $_GET['user'] = ""; }
if(!isset($_GET['force-to-watch'])) { $_GET['force-to-watch'] = false; }

$json = "https://hummingbird.me/api/v1/users/" . $_GET['user'] . "/library";

/* 
 * Check if USERNAME if valid
 * If not: return false
 * If yes: return true
 */
function getAPI($username) {
	global $json;
	
	$library = @file_get_contents($json);
		
	if($library == FALSE) {
		return FALSE;
	} else {
		return TRUE;
	}
}

/* 
 * Get a random anime from USERNAME's plan-to-watch
 */
function getRandomAnime() {
	$currentlywatching = "https://hummingbird.me/api/v1/users/" . $_GET['user'] . "/library?status=currently-watching";
	$plantowatch = "https://hummingbird.me/api/v1/users/" . $_GET['user'] . "/library?status=plan-to-watch";
	
	//Check if force-to-watch is on
	if($_GET['force-to-watch'] == true) {
		// Check if currently-watching containst more than 5 items, if so a random anime from currently-watching should be selected
		if(count($currentlywatching) > 5) {
			$selection = json_decode(file_get_contents($currentlywatching), true);
		} else {
			$selection = json_decode(file_get_contents($plantowatch), true);
		}
	} else {
		$selection = json_decode(file_get_contents($plantowatch), true);
	}
	
	$random = $selection[array_rand($selection)];
	
	// Loop to make sure anime is already airing
	while($random['anime']['started_airing'] == NULL) {
		$random = $selection[array_rand($selection)];
	}
	$random_title = $random['anime']['title'];
	$random_alt_title = $random['anime']['alternate_title'];
	echo "<h1 class='big text center'>$random_title</h1>";
	echo "<h2 class='medium text center'>$random_alt_title</h2>";
}