<?php

use App\Models\PersonTitulsModel;
use Globals\Database;

$db = new Database();
$tituls = new PersonTitulsModel($db);

?>


<div id="shablone">
    <label for="titul_id">Titul id</label><br><br>
    <select id="titul_id" name="person_tituls_id[]" required>
        <?php foreach ($tituls->getAll() as $titul): ?>
            <option value="<?= $titul->id; ?>"><?= $titul->code; ?> </option>
        <?php endforeach; ?>
    </select><br><br>
</div>