<?php

namespace test_mvc\controllers;

use test_mvc\core\App;
use test_mvc\core\AppController;

    class Controller_Login extends AppController
    {

        function action_default()
        {
            if (isset($_POST['username']) and
                isset($_POST['password']) and
                preg_match("/^http:\/\/".$_SERVER['HTTP_HOST']."/i",$_SERVER['HTTP_REFERER']))
            {
                $username = $_POST['username'];
                $password = $_POST['password'];

                if(($username=="admin") and ($password=="123"))
                {
                    $data["login_status"] = "access_granted";

                    $_SESSION['username'] = $username;
                    $_SESSION['password'] = $password;
                    $_SESSION['user_role'] = "ROLE_ADMIN";
                    header('Location:/Admin/');
                }
                else
                {
                    $data["login_status"] = "access_denied";
                }
            }
            else
            {
                $data["login_status"] = "";
            }

            $this->view->generate('login_view.php', 'template_view.php', $data); //
        }

        public function action_logout()
        {
            App::logout();
            header("Location:/");
        }
    }
