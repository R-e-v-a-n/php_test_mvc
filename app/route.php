<?php

namespace test_mvc;
use test_mvc\classes\Error;

    class Route
    {
        static function start()
        {
            $controller_name    = 'Main';
            $action_name        = 'default';

            $param1             = '';
            $param2             = '';

            $routes             = explode('/',$_SERVER["REQUEST_URI"]);

            if(!empty($routes[1])) $controller_name = $routes[1];
            if(!empty($routes[2])) $action_name     = $routes[2];
            if(!empty($routes[3])) $param1 = $routes[3];
            if(!empty($routes[4])) $param2 = $routes[4];

            $controller_name    = 'Controller_'.$controller_name;
            $action_name        = 'action_'.$action_name;

            $controller_file    = strtolower($controller_name).'.php';
            $controller_path    = 'app/controllers/'.$controller_file;

            if(file_exists($controller_path))
            {
                $controller_name = '\\test_mvc\\controllers\\'.$controller_name;
            }
            else
            {
                Error::Page404();
                return;
            }

            $controller         = new $controller_name;
            $action             = $action_name;
            $controller->set_params($param1,$param2);

            if(method_exists($controller,$action)) $controller->$action();
            else Error::Page404();
        }
    }