<?php

use App\Models\PersonsModel;
use App\Models\PersonTitulsModel;
use App\Models\WorksPositionsModel;
use Globals\Database;

$db = new Database();
$persons = new PersonsModel($db);
$works_positons = new WorksPositionsModel($db);
$tituls = new PersonTitulsModel($db);

?>


<section id="persons" class="mt-5 w-100">
    <div class="left w-50">
        <table class="">
            <thead>
            <tr>
                <th>Name</th>
                <th>Surmane</th>
                <th>Titul</th>
                <th>Email</th>
                <th>Telephone</th>
                <th>Works</th>
                <th>Salary</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($persons->getAll() as $person): ?>
                <tr>
                    <td><?= $person->name; ?></td>
                    <td><?= $person->surname; ?></td>
                    <td><?php foreach ($tituls->getPersonTituls($person->p_id) as $titul) {
                            echo $titul->code . ', ';
                        } ?></td>
                    <td><?= $person->email; ?></td>
                    <td><?= $person->telephone; ?></td>
                    <td><?= $person->work_name; ?></td>
                    <td><?= $persons->getSalary($person->p_id)->salary;?></td>
                    <td>
                        <a href="<?= packageFille('personDetail') . '?id=' . $person->p_id; ?>">Detail</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="right w-50">
        <form method="POST" action="<?= packageFille('person') ?>" class="left">
            <?= CSRF(); ?>

            <label for="name">Name</label><br><br>
            <input type="text" id="name" name="name" value="Meno"<br><br>

            <label for="surname">Surname</label><br><br>
            <input type="text" id="surname" name="surname" value="Priezvisko"><br><br>

            <div id="titul_group">
                <?php require_once 'View/Components/TitulPersonComponent.php'; ?>
            </div>
            <a href="javascript:new_title()">Add titul </a><br><br>

            <label for="email">Email</label><br><br>
            <input type="email" id="email" name="email" value="e@e.sk"><br><br>

            <label for="telephone">Telephone</label><br><br>
            <input type="text" id="telephone" name="telephone" value="987"><br><br>

            <label for="work">Work</label><br><br>
            <select id="work" name="works_positons_id">
                <?php foreach ($works_positons->getAll() as $work): ?>
                    <option value="<?= $work->id; ?>"><?= $work->work_name; ?> </option>
                <?php endforeach; ?>
            </select><br><br>

            <label for="salary">Salary</label><br><br>
            <input type="number" id="salary" name="salary" value="123"><br><br>

            <input type="hidden" name="METHOD" value="create">
            <button type="submit">Create</button>
        </form>
    </div>
</section>
<!-- Script for add new title for person -->
<script type="text/javascript" src="<?= packageFille('View/Access/Js/js.js'); ?>"></script>

