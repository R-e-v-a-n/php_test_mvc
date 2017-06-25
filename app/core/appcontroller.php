<?php

namespace test_mvc\core;

    class AppController {

        public $model;
        public $view;

        public $param1;
        public $param2;

        function __construct()
        {
            $this->view = new AppView();
        }

        public function check_post_data($fields)
        {
            foreach ($fields as $field) 
                if(!isset($_POST[$field]))       
                    return false;     

            return true;
        }

        function set_params($param1, $param2)
        {
            $this->param1 = $param1;
            $this->param2 = $param2;
        }

        function action_default()
        {

        }
    }