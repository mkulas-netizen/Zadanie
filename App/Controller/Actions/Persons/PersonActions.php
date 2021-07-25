<?php

use App\Controller\MethodController;
use App\Models\PersonsModel;
use Globals\Database;

$db = new Database();
$work  = new MethodController($_POST,$model = new PersonsModel($db),$person = new \App\Models\PersonTitulsModel($db));
$work->createOrUpdate();




