<?php


namespace App\Models;


use Globals\Database;

class PersonTitulsModel
{
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getOne($id)
    {
        return $this->db->getOne('SELECT * FROM person_tituls where id = :id', ['id' => $id]);
    }

    public function getAll()
    {
        return $this->db->getAll('SELECT * FROM person_tituls');
    }

    public function getPersonTituls($id){
        return $this->db->getAll('Select pt.*  From pivot_titul_person ptp 
                                        left join persons p ON p.id = ptp.persons_id 
                                        left join person_tituls pt ON pt.id = ptp.person_tituls_id 
                                        where ptp.persons_id = :id',['id' => $id]);
    }

    public function create($data)
    {
        return $this->db->query("INSERT INTO pivot_titul_person (persons_id,person_tituls_id) 
                                       VALUES (:persons_id,:person_tituls_id) ",
            [
                'persons_id' => $data['persons_id'],
                'person_tituls_id' => $data['person_tituls_id'],
            ]
        );
    }

    public function delete($id)
    {
        return $this->db->query("DELETE FROM pivot_titul_person where persons_id = :id" ,['id' => $id]);
    }

}