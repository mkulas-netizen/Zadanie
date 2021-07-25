<?php


namespace Globals;


use Exception;


class Sessions
{


    /**
     * GENERATE CSRF_TOKEN
     * @param $int
     * @return string
     * @throws Exception
     */
    public function CSRFToken($int): string
    {
        if( !session_id() ) session_name(APP_NAME); @session_start();
        if(!isset($_SESSION['CSRF_TOKEN'])) {
            $token = bin2hex(random_bytes($int));
            $_SESSION['CSRF_TOKEN'] = $token;
        } else {
            $token = bin2hex($_SESSION['CSRF_TOKEN']);
        }
        return $token;
    }


    /**
     * @return mixed|string
     * @throws Exception
     */
    public function GetCSRF(){

        if (isset($_SESSION['CSRF_TOKEN'])){
            $token = $_SESSION['CSRF_TOKEN'];
        } else {
            $token = $this->CSRFToken(32);
            header("Refresh:0");
        }
        return $token;
    }

}