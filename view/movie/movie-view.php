<?php
$movie = $res[0]; ?>

<h1><b>Title:</b> <?= $movie->title ?></h1>

<ul>
    <li><img  src="../../<?= $movie->image ?>"></li>
    <li><h2>Id:</h2> <?= $movie->id ?></li>
    <li><h2>Year:</h2> <?= $movie->year ?></li>
</ul>
