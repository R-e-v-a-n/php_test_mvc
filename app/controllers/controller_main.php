<?php

namespace test_mvc\controllers;
use \test_mvc\core\AppController;

    class Controller_Main extends AppController
    {

        function action_default()
        {
            $this->view->generate('main_view.php', 'template_view.php'); //
        }
    }