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

$result = $trackId->lookUp('b91c6c58-4417-4f53-92c1-db3fa3c7dc20');

echo $result->getBody()->getContents();
