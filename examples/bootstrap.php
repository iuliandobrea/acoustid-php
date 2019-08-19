<?php

# We use Dotenv library for config management
$dotenv = Dotenv\Dotenv::create(__DIR__ . '/../');
$dotenv->load();
$dotenv->required(['API_APPLICATION_TOKEN', 'API_USER_TOKEN'])->notEmpty();

# Set exception handler
$whoops = new \Whoops\Run;
$whoops->prependHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();
