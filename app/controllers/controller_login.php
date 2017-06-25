<?php

namespace test_mvc\controllers;

use test_mvc\core\App;
use test_mvc\core\AppController;
use test_mvc\classes\DB;

    class Controller_Login extends AppController
    {

        function action_default()
        {
            if (isset($_POST['username']) and
                isset($_POST['password']) and
                preg_match("/^http:\/\/".$_SERVER['HTTP_HOST']."/i",$_SERVER['HTTP_REFERER']))
            {

                $_SESSION['username'] = trim($_POST['username'], ENT_QUOTES);
                $_SESSION['password'] = trim(htmlspecialchars($_POST['password'], ENT_QUOTES));

                $user = App::check_login();
                if($user != null)
                {
                    $_SESSION['user_role'] = $user["role"];
                    header('Location:/Admin/');
                    return;
                }

                $data["login-error"] = "access_denied";
            }
            else
            {
                $data["login-error"] = "";
            }

            $this->view->generate('main_view.php', 'template_view.php', $data); //
        }

        public function action_logout()
        {
            App::logout();
            header("Location:/");
        }
    }
