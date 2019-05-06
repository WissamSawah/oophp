<?php
if (!$resultset) {
    return;
}
?>

<table>
    <tr class="first">
        <th>Rad</th>
        <th>Id</th>
        <th>Bild</th>
        <th>Titel</th>
        <th>År</th>
        <th>Action</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><img class="thumb" src="../<?= $row->image ?>"></td>
        <td><a href="showMovie/<?=$row->id?>"><?= $row->title ?></a></td>
        <td><?= $row->year ?></td>
        <td><a href="editMovie/<?=$row->id?>"><i class="fas fa-edit"></i></a> |
            <a href="deleteMovie/<?=$row->id?>"><i class="fas fa-trash-alt"></i></a><br></td>
    </tr>
<?php endforeach; ?>
</table>
