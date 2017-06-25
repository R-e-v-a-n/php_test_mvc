<?php

namespace test_mvc\core;
use test_mvc\classes\Config;

    class AppView
    {
        function generate($content_view, $template_view, $data = null)
        {
            include Config::get('VIEWS_PATH').$template_view;
        }
    }
