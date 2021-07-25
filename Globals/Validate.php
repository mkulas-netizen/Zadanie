<?php


namespace Globals;


class Validate
{
    /**
     * @param $request = $_POST or $_GET
     * @return string
     */
    public static function validate($request)
    {

        $name = filterInput($request, 'name','must string', FILTER_SANITIZE_STRING);
        $standard_salary = filterInput($request, 'standard_salary','must number', FILTER_SANITIZE_NUMBER_INT);
        $surname = filterInput($request, 'surname','must string', FILTER_SANITIZE_STRING);
        $work_name = filterInput($request, 'work_name','must string', FILTER_SANITIZE_STRING);
        $email = filterInput($request, 'email','must email', FILTER_SANITIZE_EMAIL);
        $telephone = filterInput($request, 'telephone','must string', FILTER_SANITIZE_STRING);
        $works_positons_id = filterInput($request, 'works_positons_id','must number', FILTER_SANITIZE_NUMBER_INT);

        if ($name) {
            return $name;
        }

        if ($standard_salary) {
            return $standard_salary;
        }
        if ($surname) {
            return $surname;
        }
        if ($work_name) {
            return $work_name;
        }
        if ($email) {
            return $email;
        }
        if ($telephone) {
            return $telephone;
        }
        if ($works_positons_id) {
            return $works_positons_id;
        }



    }
}