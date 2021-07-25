<?php


namespace App\Models;


use Globals\Database;

class PersonsModel
{

    /**
     * @var Database SELECT salary
     * FROM persons AS T1
     * INNER JOIN works_positions AS T2
     * WHERE T2.standard_salary <> T1.salary AND T1.id = 34 group by (salary)
     */
    protected $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function getOne($id)
    {
        return $this->db->getOne("SELECT * , p.id AS p_id  FROM persons p 
                                        left join works_positions wp On wp.id = p.works_positons_id where p.id = :id", ['id' => $id]);
    }

    public function getAll()
    {
        return $this->db->getAll('SELECT * , p.id AS p_id  FROM persons p 
                                        left join works_positions wp On wp.id = p.works_positons_id
                                        ');
    }


    public function getSalary($id)
    {
        return $this->db->getOne('SELECT  IF(STRCMP(p.salary,wp.standard_salary),p.salary,wp.standard_salary)  AS salary
                                       FROM persons p
                                        inner join works_positions wp On wp.id = p.works_positons_id
                                        where p.id = :id', ['id' => $id]);
    }


    public function update($data)
    {
        return $this->db->query(
            "UPDATE persons SET 
            name = '" . $data['name'] . "' ,
            surname = '" . $data['surname'] . "' , 
            email = '" . $data['email'] . "' ,
            telephone = '" . $data['telephone'] . "' , 
            works_positons_id = " . $data['works_positons_id'] . " , 
            salary = '" . $data['salary'] . "' 
         WHERE id = :id",
            ['id' => $data['id']]);
    }


    public function create($data)
    {
        return $this->db->query("INSERT INTO persons (name,surname,email,telephone,works_positons_id,salary) 
                                       VALUES (:name,:surname,:email,:telephone,:works_positons_id,:salary) ",
            [
                'name' => $data['name'],
                'surname' => $data['surname'],
                'email' => $data['email'],
                'telephone' => $data['telephone'],
                'works_positons_id' => $data['works_positons_id'],
                'salary' => $data['salary'],
            ]
        );
    }

    public function delete($id)
    {
        $this->db->query("DELETE FROM pivot_titul_person where persons_id = :id", ['id' => $id]);
        return $this->db->query('DELETE FROM persons where id = :id', ['id' => $id]);
    }

    public function lastId()
    {
        return $this->db->lastId();
    }

}