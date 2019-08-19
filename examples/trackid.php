<?php

require_once '../vendor/autoload.php';
require_once 'bootstrap.php';

$trackId = new \AcoustId\LookUp\TrackId(getenv('API_APPLICATION_TOKEN'));

# Optional response type and callback
//$lookUp->setFormat('jsonp')->setJsonCallBack('testCallback');

# Set required meta
$trackId->setMetaData([
    \AcoustId\LookUp::META_RECORDINGS,
    \AcoustId\LookUp::META_RECORDINGIDS,
]);

$result = $trackId->lookUp('5dfed459-fd8f-40d7-9d93-...');

echo $result->getBody()->getContents();
