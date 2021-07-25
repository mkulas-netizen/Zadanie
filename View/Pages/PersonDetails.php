<?php

use App\Models\PersonsModel;
use App\Models\PersonTitulsModel;
use App\Models\WorksPositionsModel;
use Globals\Database;

$db = new Database();
$persons = new PersonsModel($db);
$person = $persons->getOne($_GET['id']);
$works_positons = new WorksPositionsModel($db);
$work_position = $works_positons->getOne($person->works_positons_id);
$tituls = new PersonTitulsModel($db);


?>
<section id="worksDetails" class="mt-5">
    <form method="POST" action="<?= packageFille('person') ?>" class="left">
        <?= CSRF(); ?>

        <label for="name">Name</label><br><br>
        <input type="text" id="name" name="name" value="<?= $person->name; ?>"><br><br>

        <label for="surname">Surname</label><br><br>
        <input type="text" id="surname" name="surname" value="<?= $person->surname; ?>"><br><br>

        <b>Person titul</b>
        <?php foreach ($tituls->getPersonTituls($_GET['id']) as $titul): ?>
            <div id="titul" class="remove">
                <p><?= $titul->code; ?>  <a class="remove red">Delete</a></p>
                <input type="hidden" id="titul_id" name="person_tituls_id[]" value="<?= $titul->id; ?>">
            </div>
        <?php endforeach; ?>
        <script>
            document.querySelectorAll('.remove').forEach(a => a.addEventListener('click', function (e) {
                this.parentNode.removeChild(this)
            }));
        </script>

        <label for="titul_id">New titul</label><br><br>
        <select id="titul_id" name="person_tituls_id[]">
            <option selected value=""></option>
            <?php foreach ($tituls->getAll() as $titul): ?>
                <option value="<?= $titul->id; ?>"><?= $titul->code; ?> </option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="email">Email</label><br><br>
        <input type="text" id="email" name="email" value="<?= $person->email; ?>"><br><br>

        <label for="telephone">Telephone</label><br><br>
        <input type="text" id="telephone" name="telephone" value="<?= $person->telephone; ?>"><br><br>

        <label for="work">Work</label><br><br>
        <select id="work" name="works_positons_id">
            <option value="<?= $work_position->id; ?>"
                    selected><?= $work_position->work_name; ?></option>
            <?php foreach ($works_positons->getAll() as $work): ?>
                <option value="<?= $work->id; ?>"><?= $work->work_name; ?> </option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="salary">Salary</label><br><br>
        <input type="text" id="salary" name="salary" value="<?= $person->salary; ?>"><br><br>

        <input type="hidden" name="id" value="<?= $person->p_id; ?>">
        <input type="hidden" name="METHOD" value="update">

        <button type="submit">Edit</button>
    </form>
    <br>
    <form method="POST" action="<?= packageFille('deletePerson') ?>">
        <?= CSRF(); ?>
        <input type="hidden" name="id" value="<?= $person->p_id; ?>">
        <input type="hidden" name="METHOD" value="delete">
        <button type="submit">DELETE</button>
    </form>
</section>
