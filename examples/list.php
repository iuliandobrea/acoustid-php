<?php

require_once '../vendor/autoload.php';
require_once './bootstrap.php';

$list = new \AcoustId\ListByMBId(getenv('API_APPLICATION_TOKEN'));
$list->setJSONResponseType();
$result = $list->search('4e0d8649-1f89-44f3-91af-...');

echo $result->getBody()->getContents();
