<?php

/**
 * This is a part of examples package. How to look up data by fingerprint.
 * Fingerprints are obtained by using the fpcalc utility. See AcoustId web site for details.
 */

$lookUp = new \AcoustId\LookUp\FingerPrint($d, $f);
$lookUp->setFormat('json');

# Available meta data to get from service
//$lookUp->setMeta(['recordings', 'recordingids', 'releases', 'releaseids', 'releasegroups', 'releasegroupids', 'tracks', 'compress', 'usermeta', 'sources']);

# You can set the callback functions
//$lookUp->setJsonCallBack('test');

# Set basic data
$lookUp->setMeta(['recordings']);

$response = $client->lookUp(
    $lookUp
);
echo $response->getBody()->getContents();