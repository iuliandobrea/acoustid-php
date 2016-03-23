<?php

/**
 * This is a part of examples package. How to submit new data by batch request
 */

$userId = get('u');

if (empty($userId)) {
    throw new \AcoustId\Exception('Please provide the $userId parameter by passing the ?u=xxx parameter, where xxx is your userId from AcoustId web service.');
}

# Pass $d - duration and $f - fingerPrint parameters as arrays, where $d[0] corresponds $f[0]
$submission = new \AcoustId\Submission\Batch($userId, $d, $f);

# Set optional wait timeout
$submission->setWait(10);

$response = $client->submissionBatch(
    $submission
);

echo $response->getBody()->getContents();