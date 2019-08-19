<?php

require_once '../vendor/autoload.php';
require_once './bootstrap.php';

$x    = exec(escapeshellcmd('fpcalc -json ./../mp3/some-track.mp3'), $output, $return);
$data = json_decode($output[0]);

$id3   = new getID3();
$file1 = $id3->analyze('./../mp3/some-track.mp3');

$submission = new \AcoustId\Submission(getenv('API_APPLICATION_TOKEN'));
$result     = $submission->setJSONResponseType()
    ->setWait(1)
    ->setDuration($data->duration)
    ->setUserToken(getenv('API_USER_TOKEN'))
    ->setFingerPrint($data->fingerprint)
    ->setAlbumArtist($file1['id3v2']['comments']['artist'][0])
    ->setTrackTitle($file1['id3v2']['comments']['title'][0])
    ->setTrackNo(20)
    ->send();

echo $result->getBody()->getContents();
