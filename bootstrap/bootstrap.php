<?php

    define('DOCUMENT_ROOT', __DIR__ . '/../');

    require_once (DOCUMENT_ROOT . '/vendor/autoload.php');

    require_once (DOCUMENT_ROOT . 'class/REALESTATECOM.php');

    $dotenv = new Dotenv\Dotenv(DOCUMENT_ROOT);
    $dotenv->load();

?>