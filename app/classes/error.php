<?php

namespace test_mvc\classes;

class Error
{
    public static function Page404(){
        $host = 'http://'.$_SERVER["HTTP_HOST"]."/";
        echo   '<script type="text/javascript">'.
            'window.location.replace(\'' .$host. '404\');'.
            '</script>'.
            '<noscript>'.
            '<meta http-equiv="refresh" content="0; url=' .$host. '404">'.
            '</noscript>';
    }
}