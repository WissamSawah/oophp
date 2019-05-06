
<?php
if (!$res) {
    return;
}
?>

<table class="table table-dark">
    <tr class="first">
        <th scope="col">Rad</th>
        <th scope="col">Id</th>
        <th scope="col">Bild</th>
        <th scope="col">Titel</th>
        <th scope="col">År</th>
    </tr>
<?php $id = -1; foreach ($res as $row) :
    $id++; ?>
    <tr>
        <td scope="row"><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><img class="img-responsive" height="100px" width="100px" src="<?= $row->image ?>"></td>
        <td><?= $row->title ?></td>
        <td><?= $row->year ?></td>
    </tr>
<?php endforeach; ?>
</table>

<?php
if (!$resultset) {
    return;
}
?>
