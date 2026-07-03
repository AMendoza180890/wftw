<?php

require_once __DIR__ . '/../vendor/autoload.php';

Dotenv\Dotenv::createImmutable(dirname(__DIR__))->safeLoad();

require_once __DIR__ . '/helpers.php';

app\controlador\authC::startSession();
