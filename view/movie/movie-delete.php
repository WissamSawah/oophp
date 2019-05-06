<?php
// var_dump($res);
$movie = $res[0];
?>

<form method="post">
        <h1>Are you sure?</h1></br><br>
        <input type="hidden" name="movieId" value="<?= $movie->id ?>"/>
        <input type="submit" name="doSave" value="Yes, delete movie">

</form>
