<?php
    namespace test_mvc;

    require_once __DIR__.DIRECTORY_SEPARATOR.'NamespaceAutoLoader.php';

    $autoLoader = new \NamespaceAutoLoader();
    $autoLoader->addNamespace('test_mvc', __DIR__);
    $autoLoader->register();

    classes\DB::getInstance();
    Route::start();
