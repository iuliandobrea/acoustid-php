<?php

if (file_exists(__DIR__ . '/../.env')) {
    # Identification tokens for client's API calls.
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
    $dotenv->required(['API_APPLICATION_TOKEN', 'API_USER_TOKEN'])->notEmpty();
}
