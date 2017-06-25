<?php

namespace test_mvc\controllers;

use test_mvc\core\App;
use test_mvc\core\AppController;

    class Controller_Admin extends AppController
    {

        function action_default()
        {
            if (App::check_login() != null)
            {
                $this->view->generate('admin_view.php', 'template_view.php');
            }
            else
            {
                header('Location:/Login');
            }
        }
    }
