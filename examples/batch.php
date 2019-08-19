<?php

require_once '../vendor/autoload.php';
require_once './bootstrap.php';

$batch = new \AcoustId\Submission\Batch(getenv('API_APPLICATION_TOKEN'));
$batch->setUserToken(getenv('API_USER_TOKEN'));
$batch->setWait(5);

$batch->setBatch([
    (new AcoustId\Submission($batch->getClientAPIToken()))->setFingerPrint('test1')->setDuration(1),
    (new AcoustId\Submission($batch->getClientAPIToken()))->setFingerPrint('test2')->setDuration(2),
]);

$result = $batch->sendBatch();

echo $result->getBody()->getContents();
