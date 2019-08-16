<?php

# Identification tokens for client's API calls. Example from web site - surely is expired. Use your own one
$dotenv = Dotenv\Dotenv::create(__DIR__ . '/../');
$dotenv->load();

$dotenv->required(['API_APPLICATION_TOKEN', 'API_USER_TOKEN'])->notEmpty();