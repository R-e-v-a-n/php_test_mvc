<?php
namespace test_mvc\controllers;
use test_mvc\core\AppController;

    class Controller_404 extends AppController
    {
        function action_default()
        {
            $this->view->generate('404_view.php', 'template_view.php'); //
        }
    }
