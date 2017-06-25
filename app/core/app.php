<?php

namespace test_mvc\core;

use test_mvc\classes\DB;

class App
{
    public static function check_login()
    {
        if(isset($_SESSION["username"]) and isset($_SESSION["password"]))
        {
            $username = $_SESSION["username"];
            $password = $_SESSION["password"];

            $template = '/^[a-z][a-z\d]*(_[a-z\d]+)?$/i';
            if(preg_match($template, $username))
            {
                $result = DB::query("SELECT * FROM users_view WHERE `username`='$username' AND `password`=MD5('$password')");

                if(!empty($result))
                {
                    return $result[0];
                }
            }
        }

        App::logout();
        return null;
    }

    public static function logout()
    {
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        unset($_SESSION['user_role']);
    }
}