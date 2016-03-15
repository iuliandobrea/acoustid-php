<?php

/**
 * This is a part of examples package. How to submit new data
 */

$userId = get('u');

if (empty($userId)) {
    throw new \AcoustId\Exception('Please provide the $userId parameter by passing the ?u=xxx parameter, where xxx is your userId from AcoustId web service.');
}

$submission = new \AcoustId\Submission($userId, $d, $f);
$response   = $client->submission(
    $submission
);
echo $response->getBody()->getContents();