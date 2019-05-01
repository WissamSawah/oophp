<?php

namespace Aisa\Dice;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DiceController implements AppInjectableInterface
{
    use AppInjectableTrait;




    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : string
    {
        // Deal with the action and return a response.
        return "Index";
    }




    public function debugAction() : string
    {
        // Deal with the action and return a response.
        return "Debug my game!";
    }





    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function initAction() : object
    {
        // init the session for the game start;
        $title = "Dice100 (1)";
        //session_name("game");
        // POST incoming
        $player1 = !is_null($this->app->request->getPost('player1')) ?? 0;
        $player2 = !is_null($this->app->request->getPost('player2')) ?? 0;
        $game = new Dice($player1, $player2);
        $_SESSION = [];
        return $this->app->response->redirect("Dice1/play");
    }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function playAction() : object
    {
        //session_name("game");
        // POST incoming
        $title = "Dice100(1)";
        $player1 = !is_null($this->app->request->getPost('player1')) ?? 0;
        $player2 = !is_null($this->app->request->getPost('player2')) ?? 0;
        // Start up the session game
        if (!$this->app->session->has('game')) {
            $this->app->session->set('game', new Dice($player1, $player2));
        }
        // SESSION
        $game = $this->app->session->get('game');
        // $game = $this->this->app->session->set('game');

        // Reset the game
        if (!is_null($this->app->request->getPost('reset'))) {
        // Unset all of the session variables.
                $this->app->session->destroy();
        }
        if (!is_null($this->app->request->getPost('player1'))) {
            $game->rollPlayer1();
        }
        if (!is_null($this->app->request->getPost('player2'))) {
            $game->rollPlayer2();
        }
        if (isset($_POST["turn"])) {
            $game->unavailable(0);
        }
        $dice = new \Aisa\Dice\DiceHistogram();
        $histogram = new \Aisa\Dice\Histogram();
        $histogram->injectData($dice);

        $data['game'] = $game;
        $data['player1'] = $player1;
        $data['player2'] = $player2;
        $data['histogram'] = $histogram;

        $this->app->view->add("/Dice1/Dice100", $data);
            return $this->app->page->render([
                "title" => $title,
            ]);
    }
}
