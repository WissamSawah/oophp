<?php
/**
 * 100 Dices with GET
 */
$app->router->any(["GET", "POST"], "100", function () use ($app) {
    $title = "Dice100 (SESSION)";
    //session_name("game");
    // POST incoming
    $player1 = $_POST["player1"] ?? 0;
    $player2 = $_POST["player2"] ?? 0;
    // Start up the session game
    if (!isset($_SESSION["game"])) {
        $_SESSION["game"] = new \Aisa\Dice\Dice($player1, $player2);
    }
    // SESSION
    $game = $_SESSION['game'];
    // Reset the game
    if (isset($_POST["reset"])) {
        // Unset all of the session variables.
        $_SESSION = [];
        // If it's desired to kill the session, also delete the session cookie.
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
        }
        // destroy the session.
        session_destroy();
        //Refresh the page
        header("Refresh:0");
    }
    if (isset($_POST["player1"])) {
        $game->rollPlayer1();
    }
    if (isset($_POST["player2"])) {
        $game->rollPlayer2();
    }
    if (isset($_POST["turn"])) {
        $game->unavailable(0);
    }
    $data['game'] = $game;
    $data['player1'] = $player1;
    $data['player2'] = $player2;
    $app->view->add("/Dice/Dice100", $data);
        return $app->page->render([
            "title" => $title,
        ]);
});
