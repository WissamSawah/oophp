<h1 class="h1-game">Tärningsspel 100 (1)</h1>
<div class="game">
    <form class="form-signin" action="" method="post">
        <?php if (!is_null($app->request->getPost('player1'))) : ?>
            <button class="give-away" type="submit" name="turn" <?= $game->getSum(0); ?>>Give my turn to PC</button><br><br>
        <?php endif; ?>
    </form>
    <form class="form-signin" method="post">
        <!-- PLAYER ONE -->
        <button class="pl1" type="submit" name="player1" <?= $game->getSum(0); ?>>Player 1</button>
        <p class="dices"><?= implode("   ", $game->getDices(0)); ?>
        <input type="hidden" name="player1" value="<?= $game->allResults(0)?>">
        <p class="sum">Sum is: <?= $game->allResults(0)?>.</p>
    </form>
    <form class="" method="post">
        <!-- PLAYER TWO -->
        <button class="pl2" type="submit" name="player2" <?= $game->getSum(1); ?>>PC</button>
        <p class="dices"><?= implode("  ", $game->getDices(1)) ?>
        <input type="hidden" name="player2" value="<?= $game->allResults(1)?>">
        <p class="sum">Sum is: <?= $game->allResults(1)?>.</p>
    </form>
    <h1 class="h1-game">Histogram:</h1>
          <p class="h1-game">Player1:</p>
        <?= $histogram->getAsText($game->getDicesHistogram(0)); ?>
          <p class="h1-game">PC:</p>
        <?= $histogram->getAsText($game->getDicesHistogram(1)); ?>
    <form class="" action="" method="post">
        <button type="submit" class="reset" name="reset">Reset</button>
    </form>
<!-- </div> -->
