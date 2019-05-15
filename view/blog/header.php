<?php
namespace Anax\View;

// $req = new \Anax\Request\Request();
// echo("Site " . $req->getSiteUrl());
// echo("Base " . $req->getBaseUrl());
// echo("Current " . $req->getCurrentUrl());
// echo("Script " . $req->getScriptName());
?>
<div class="movieNav">
    <a href="<?=url('blog/show-all')?>">Show all content | </a>
    <a href="<?=url('blog/admin')?>">Admin | </a>
    <a href="<?=url('blog/add')?>">Create | </a>
    <a href="<?=url('blog/pages')?>">View pages | </a>
    <a href="<?=url('blog/posts')?>">View blog |</a>
    <!-- <a href="<?=url('blog/logout')?>">Logout |</a> 
    <a href="<?=url('blog/login')?>">Login </a> -->


</div>
