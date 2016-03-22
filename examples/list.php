<?php

/**
 * This is a part of examples package. How to list data by MBID
 */

# Due to PHP representation of inner data in $_GET array we can not set &mbid=1&mbid=2 so we need &mbid[]=1&mbid[]=2 to have array for batch request
$list = new \AcoustId\ListByMDID($mbid);

# Optionally you can use batch requests, see params above. # If $mbid is array - the batch would be set to 1 automatically
$list->setBatch(get('batch'));

# list data
$response = $client->listByMBID($list);

echo $response->getBody()->getContents();
