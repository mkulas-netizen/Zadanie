<?php


namespace App\Controller;


use App\Models\PersonTitulsModel;
use Globals\Database;
use Globals\Validate;


class MethodController
{
    /**
     * Create or update method -> auto validate
     * @TODO bezne by bola tato metoda rozdelena na 2 metody a tie by sa volali v controllery
     * @param $request
     * @param $method
     *
     */

    protected $request;
    protected $method;
    protected $person;

    public function __construct($request, $method, PersonTitulsModel $person = null)
    {
        $this->request = $request;
        $this->method = $method;
        $this->person = $person;
    }


    public function createOrUpdate()
    {
        $request = $this->request;
        $method = $this->method;
        if (bin2hex($request["CSRF_TOKEN"]) == bin2hex($_SESSION["CSRF_TOKEN"])) {

            $validate = new Validate();
            $data = $validate::validate($this->request);
            if (empty($request['salary'])){
                $request['salary'] = null;
            }
            if (empty($data)) {
                if ($request['METHOD'] == 'create') {
                    $method->create($request);
                    if (isset($request['person_tituls_id'])) {
                        $this->multiRequest($method->lastId());
                    }
                }
                if ($request['METHOD'] == 'update') {
                    $method->update($request);
                    $id = $request['id'];
                    if (isset($request['person_tituls_id'])) {
                        $this->multiRequest($id, true);
                    }
                }
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                echo $data;
                die();
            }
        } else {
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        }

    }


    public function multiRequest($id, $destroy = false)
    {
        $db = new Database();
        $person_pivot = new PersonTitulsModel($db);
        $request = $this->request;
        if ($destroy == true) {
            $person_pivot->delete($id);
        }
        foreach ($request['person_tituls_id'] as $i) {
            $data = [];
            $data['person_tituls_id'] = $i['person_tituls_id'];
            $data['persons_id'] = $id;
            $person_pivot->create($data);
        }
    }
}