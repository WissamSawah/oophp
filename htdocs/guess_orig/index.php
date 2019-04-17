
<?php

require __DIR__. "/autoload.php";
require __DIR__. "/config.php";


session_name("aisa18");
session_start();



// incoming variables

$guess = $_POST["guess"] ?? null;
$doInit = $_POST["doInit"] ?? null;
$doGuess = $_POST["doGuess"] ?? null;
$doCheat = $_POST["doCheat"] ?? null;

// Get setting from the session

$tries = $_SESSION["tries"] ?? null;
$number = $_SESSION["number"] ?? null;
$game = null;

if ($doInit || $number === null) {
    $game = new Guess();
    $_SESSION["number"] = $game->number();
    $_SESSION["tries"] = $game->tries();
} elseif ($doGuess) {
    $game = new Guess($number, $tries);
    $res = $game->makeGuess($guess);
    $_SESSION["tries"] = $game->tries();
}



require __DIR__ . "/view/guess_my_number.php";
