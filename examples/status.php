<?php

require_once '../vendor/autoload.php';
require_once 'bootstrap.php';

$status = new \AcoustId\Submission\Status(getenv('API_APPLICATION_TOKEN'));
$result = $status->setSubmissionId(1234567890)->find();
//or
$result = $status->find(1234567890);

echo $result->getBody()->getContents();
