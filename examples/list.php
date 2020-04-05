<?php

require_once '../vendor/autoload.php';
require_once './bootstrap.php';

$list = new \AcoustId\ListByMBId(getenv('API_APPLICATION_TOKEN'));
$list->setJSONResponseType();
$result = $list->search('1ecc9c02-fb87-4775-9235-30ba83708ed7');

echo $result->getBody()->getContents();
