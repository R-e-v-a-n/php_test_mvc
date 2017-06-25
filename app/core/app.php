<?php

namespace test_mvc\core;


class App
{
    public static function check_login()
    {
        if(isset($_SESSION["username"]) and isset($_SESSION["password"]))
        {
            $username = $_SESSION["username"];
            $password = $_SESSION["password"];

            if($username == "admin" and $password == "123")
            {
                return "access granted";
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