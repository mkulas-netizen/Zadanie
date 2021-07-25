<?php

use App\Controller\MethodController;
use App\Models\WorksPositionsModel;
use Globals\Database;

$db = new Database();
$model = new WorksPositionsModel($db);
$work  = new MethodController($_POST,$model = new WorksPositionsModel($db));
$work->createOrUpdate( );

