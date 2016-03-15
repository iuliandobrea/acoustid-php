<?php

/**
 * This is a part of examples package. How to look up data by track id.
 * TrackId are obtained musicbrainz library.
 */

$lookUp = new \AcoustId\LookUp\TrackId($t);

# Optional response type and callback
//$lookUp->setFormat('jsonp')->setJsonCallBack('testCallback');

# Set requested meta
$lookUp->setMeta(['recordings', 'recordingids', 'releases', 'releaseids', 'releasegroups', 'releasegroupids', 'tracks', 'compress', 'usermeta', 'sources']);

$response = $client->lookUp(
    $lookUp
);

echo $response->getBody()->getContents();