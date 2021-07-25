<?php

use App\Models\WorksPositionsModel;
use Globals\Database;

$db = new Database();
$worksPositions = new WorksPositionsModel($db);
?>

<section id="workPostions" class="w-100">
    <div class="left w-50">
        <div class="my-list">
            <ol>
                <?php foreach ($worksPositions->getAll() as $workPosition) : ?>
                    <li><a href="<?= packageFille('detail?id='). $workPosition->id; ?>"><?= $workPosition->work_name; ?></a></li>
                <?php endforeach; ?>
            </ol>
        </div>
    </div>
    <div class="right">
        <form method="post" action="<?= packageFille('/');?>">
            <?= CSRF(); ?>
            <label for="workName">New work position</label>
            <input type="text" id="workName" name="work_name" placeholder="Add new work name" >
            <label for="standard_salary">Standard salary</label>
            <input type="number" id="standard_salary" name="standard_salary" placeholder="Standard salary" required>
            <input type="submit" value="Add new Work position">
            <input type="hidden" name="METHOD" value="create">
        </form>
    </div>
</section>



