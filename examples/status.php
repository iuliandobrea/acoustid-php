<?php

/**
 * This is a part of examples package. How to get a submission status
 * 155396581 - is the submission id. Can be obtained from submission data.
 */

$status = new \AcoustId\Submission\Status(155396581);
# -1. Read the submission state
$response = $client->submissionStatus($status);
echo $response->getBody()->getContents();
