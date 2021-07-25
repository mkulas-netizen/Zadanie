<?php

use App\Models\WorksPositionsModel;
use Globals\Database;

$db = new Database();
$worksPositions = new WorksPositionsModel($db);
$data = $worksPositions->getOne($_GET['id']);

?>

<section id="worksDetails" class="mt-5">
    <form method="POST" action="<?= packageFille('detail') ?>" class="left">
        <?= CSRF(); ?>
        <label for="name">Name</label>
        <input type="text" id="name" name="work_name" value="<?= $data->work_name;?>">
        <label for="standard_salary">STANDARD SALARY</label>
        <input type="text" id="standard_salary" name="standard_salary" value="<?= $data->standard_salary;?>">
        <input type="hidden" name="id" value="<?= $data->id; ?>">
        <input type="hidden" name="METHOD" value="update">
        <button type="submit">Edit</button>
    </form><br>
    <form method="POST" class="" action="<?= packageFille('deleteWork') ?>">
        <?= CSRF(); ?>
        <input type="hidden" name="id" value="<?= $data->id; ?>">
        <input type="hidden" name="METHOD" value="pdelete">
        <button type="submit">DELETE</button>
    </form>
</section>
