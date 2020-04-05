<?php

require_once '../vendor/autoload.php';
require_once 'bootstrap.php';

$lookUp = new \AcoustId\LookUp\FingerPrint(getenv('API_APPLICATION_TOKEN'));
$result = $lookUp
    ->setJSONResponseType()
//    ->setXMLResponseType()
//    ->setJSONPResponseType('test')
    ->setMetaData([
        \AcoustId\LookUp::META_RECORDINGS,
        \AcoustId\LookUp::META_RELEASES,
        \AcoustId\LookUp::META_USERMETA,
        \AcoustId\LookUp::META_RECORDINGIDS,
    ])->lookUp(getenv('EXAMPLE_DURATION'), getenv('EXAMPLE_FINGERPRINT'));

echo $result->getBody()->getContents();
