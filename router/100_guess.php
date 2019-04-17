<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game redirect to play the game.
 */
$app->router->get("guess/init", function () use ($app) {
    // init the session for the game start;
    $game = new Aisa\Guess\Guess();
    $_SESSION["number"] = $game->number();
    $_SESSION["tries"] = $game->tries();

    return $app->response->redirect("guess/play");
});



/**
 * Play the game
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game";

    // Get setting from the session

    $tries = $_SESSION["tries"] ?? null;
    // $number = $_SESSION["number"] ?? null;
    $res = $_SESSION["res"] ?? null;
    $guess = $_SESSION["guess"] ?? null;

    $_SESSION["res"] = null;
    $_SESSION["guess"] = null;


    $data = [

        "guess" => $guess ?? null,
        "tries" => $tries,
        "number" => $number ?? null,
        "res" => $res,
        "doGuess" => $doGuess ?? null,
        "doCheat" => $doCheat ?? null,


    ];


    $app->page->add("guess/play", $data);
    // $app->page->add("guess/debug");


    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));




/**
 * Play the game
 */
$app->router->post("guess/play", function () use ($app) {

    // incoming variables

    $guess = $_POST["guess"] ?? null;
    // $doInit = $_POST["doInit"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    // $doCheat = $_POST["doCheat"] ?? null;

    // Get setting from the session

    $tries = $_SESSION["tries"] ?? null;
    $number = $_SESSION["number"] ?? null;


    if ($doGuess) {
        $game = new Aisa\Guess\Guess($number, $tries);
        $res = $game->makeGuess($guess);
        $_SESSION["tries"] = $game->tries();
        $_SESSION["res"] = $res;
        $_SESSION["guess"] = $guess;
    }
    return $app->response->redirect("guess/play");
});
