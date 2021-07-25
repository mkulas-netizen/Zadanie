<?php

namespace App\Controller;

use App\Models\WorksPositionsModel;
use Globals\Database;

class WorksController
{
    /** @TODO Za bežných okolností by sa tu nachádzali dalsie metody na create,update ...
        @Len nechcel som robit tento projekt az moc rozsiahly a až tak variabilný tak tu mam len jednoduchy rout
     */


    /**
     * @return string
     * SHOW WORKS PAGE
     */
    public function index(): string
    {
        return 'View/Pages/Works.php';
    }


    /**
     * SHOW FORM FOR EDIT
     */
    public function edit()
    {
        return 'View/Pages/WorksDetails.php';
    }


    /**
     * DELETE POST
    */

    public function destroy()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['CSRF_TOKEN'] == $_SESSION['CSRF_TOKEN'] && $_POST['METHOD'] == 'pdelete') {

            $db = new Database();
            $work = new WorksPositionsModel($db);
            $work->delete($_POST['id']);
            header('Location: ' . packageFille('/'));
            die();
        } else {
            return 'Vies/ServerPages/Error.php';
        }

    }
}