<?php
namespace Anax\View;

// $req = new \Anax\Request\Request();
// echo("Site " . $req->getSiteUrl());
// echo("Base " . $req->getBaseUrl());
// echo("Current " . $req->getCurrentUrl());
// echo("Script " . $req->getScriptName());
?>
<div class="movieNav">
    <a href="<?=url('movie_one/init')?>">Movies | </a>
    <a href="<?=url('movie_one/searchTitle')?>">Search Title | </a>
    <a href="<?=url('movie_one/searchYear')?>">Search Year | </a>
    <a href="<?=url('movie_one/addMovie')?>">Add Movie | </a>
    <a href="<?=url('movie_one/sort')?>">Show all sortable |</a>
    <a href="<?=url('movie_one/paginate')?>">Show all paginate |</a>
</div>
