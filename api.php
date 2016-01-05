<?php

// Get rid of stupid errors when GET is not set
if (!isset($_GET['user'])) {
    $_GET['user'] = '';
}
if (!isset($_GET['force-to-watch'])) {
    $_GET['force-to-watch'] = false;
}

/*
 * Check if USERNAME if valid
 * If not: return false
 * If yes: return true
 */
function getAPI($username)
{
    $user = 'https://hummingbird.me/api/v1/users/'.$_GET['user'];

    $library = @file_get_contents($user);

    if ($library == false) {
        return false;
    } else {
        return true;
    }
}

/*
 * Get a random anime from USERNAME's plan-to-watch
 */
function getRandomAnime()
{
    $currentlywatching = json_decode(file_get_contents('https://hummingbird.me/api/v1/users/'.$_GET['user'].'/library?status=currently-watching'), true);
    $plantowatch = json_decode(file_get_contents('https://hummingbird.me/api/v1/users/'.$_GET['user'].'/library?status=plan-to-watch'), true);

    //Check if force-to-watch is on
    if ($_GET['force-to-watch'] == true) {
        // Check if currently-watching containst more than 5 items, if so a random anime from currently-watching should be selected
        if (count($currentlywatching) > 5) {
            $selection = $currentlywatching;
        } else {
            $selection = $plantowatch;
        }
    } else {
        $selection = $plantowatch;
    }

    $random = $selection[array_rand($selection)];

    // Loop to make sure anime is already airing
    while ($random['anime']['status'] == 'Not Yet Aired') {
        $random = $selection[array_rand($selection)];
    }
    $random_title = $random['anime']['title'];
    $random_alt_title = $random['anime']['alternate_title'];
    $random_link = $random['anime']['url'];
    echo "<h1 class='big text center'><a href='$random_link' target='_blank'>$random_title</a></h1>";
    echo "<h2 class='medium text center'>$random_alt_title</h2>";
}
