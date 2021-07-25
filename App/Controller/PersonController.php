<?php


namespace App\Controller;


use App\Models\PersonsModel;
use Globals\Database;

class PersonController
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
        return 'View/Pages/Persons.php';
    }


    /**
     * @return string
     * SHOW FORM FOR EDIT
     */
    public function edit()
    {
        return 'View/Pages/PersonDetails.php';
    }


    /**
     * @return bool
     * DELETE POST
    */


    public function destroy()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['CSRF_TOKEN'] == $_SESSION['CSRF_TOKEN'] && $_POST['METHOD'] == 'delete') {

            $db = new Database();
            $work = new PersonsModel($db);

            $work->delete($_POST['id']);
            header('Location: ' . packageFille('/person'));
        }
        return 'DELETE SUCCESS';
    }
}