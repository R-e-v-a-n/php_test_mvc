<?php

namespace test_mvc\controllers;
use test_mvc\core\AppController;

    class Controller_Description extends AppController
    {

        function action_default()
        {
            $this->view->generate('description_view.php', 'template_view.php'); //
        }
    }