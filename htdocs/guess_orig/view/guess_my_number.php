
<h1 class="h1-head">Guess my number (SESSION)</h1>

<link rel="stylesheet" type="text/css" href="style/style.css">
<form class="form" method="post">
    <p >Guess a number between 1 and 100.</p>
    <p> You have <strong style="color: #DC3545;"><?= $tries ?></strong> tries left.</p>

    <input class="txt" type="number" name="guess" placeholder="Your guess"><br>
    <input class="make" type="submit" name="doGuess" value="Make a guess"><br>
    <input class="make" type="submit" name="doCheat" value="Cheat"><br>
    <input class="start" type="submit" name="doInit" value="Reset"><br>

</form>

<?php if ($doGuess && $tries > 0) : ?> 
    <p>Your guess <?= $guess ?> is <b style="color: #DC3545;"><?= $res ?></b></p>
<?php endif; ?>
<?php if ($doCheat) : ?>
    <p>CHEAT: Current number is  <?= $number ?>.</p>
<?php endif; ?>

<?php if ($tries === 0) : ?>
    <p> You have no tries left. Please reset the game  <?= $tries ?>.</p>
<?php endif; ?>

<p>© Wissam Sawah 2019</p>
