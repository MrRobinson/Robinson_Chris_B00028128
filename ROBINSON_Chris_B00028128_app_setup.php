<?php

    require_once __DIR__ .'/../vendor/autoload.php';

    $myTemplatesPath = __DIR__ .'/../templates';

    $loader = new Twig_Loader_Filesystem($myTemplatesPath);
    $twig = new Twig_Environment($loader);