<?php


namespace App\Models;



use Globals\Database;

class WorksPositionsModel
{
    protected Database $db;

    public function __construct($db){
        $this->db = $db;
    }

    public function getOne($id)
    {
        return $this->db->getOne('SELECT * FROM works_positions where id = :id', ['id' => $id]);
    }

    public function getAll()
    {
        return $this->db->getAll('SELECT * FROM works_positions order by id DESC');
    }


    public function update($data){

        return $this->db->query("UPDATE works_positions SET work_name = '". $data['work_name'] . "' , standard_salary = ". $data['standard_salary']." WHERE id = :id",['id' => $data['id']]);
    }


    public function create($data){
        return $this->db->query("INSERT INTO works_positions (work_name,standard_salary) VALUES(:work_name,:standard_salary) ",
            [
                'work_name' => $data['work_name'],
                'standard_salary' => $data['standard_salary']
            ]
        );
    }

    public function delete($id){
        return $this->db->query('DELETE FROM works_positions where id = :id',['id' => $id]);
    }


}