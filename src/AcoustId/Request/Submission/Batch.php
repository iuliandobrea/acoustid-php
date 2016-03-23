<?php namespace AcoustId\Request\Submission;

use AcoustId\Request;

/**
 * Class Batch
 *
 * @package AcoustId\Request\Submission
 */
class Batch extends Request
{
    /**
     * Batch constructor.
     *
     * @param \AcoustId\Submission\Batch $instance
     */
    public function __construct($instance)
    {
        parent::__construct($instance);
    }

    /**
     * @return $this
     */
    public function createRequest()
    {
        $this->setUrl($this->instance->getUrl());

        $this->params['client'] = $this->instance->getClientId();
        $this->params['user']   = $this->instance->getUser();

        if (!empty($this->instance->getDuration())) {
            foreach ($this->instance->getDuration() as $k => $v) {
                $this->params['duration.' . $k] = $v;
            }
        }

        if (!empty($this->instance->getFingerPrint())) {
            foreach ($this->instance->getFingerPrint() as $k => $v) {
                $this->params['fingerprint.' . $k] = $v;
            }
        }

        $this->params['format']        = $this->instance->getFormat();
        $this->params['clientversion'] = $this->instance->getClientVersion();
        $this->params['wait']          = $this->instance->getWait();
        $this->params['bitrate']       = $this->instance->getBitRate();
        $this->params['fileformat']    = $this->instance->getFileFormat();
        $this->params['mbid']          = $this->instance->getMBID();
        $this->params['track']         = $this->instance->getTrack();
        $this->params['artist']        = $this->instance->getArtist();
        $this->params['album']         = $this->instance->getAlbum();
        $this->params['albumartist']   = $this->instance->getAlbumArtist();
        $this->params['year']          = $this->instance->getYear();
        $this->params['trackno']       = $this->instance->getTrackNo();
        $this->params['discno']        = $this->instance->getDiscNo();

        # build query and decode - as we need clear url
        $this->setUrl($this->getUrl() . '?' . urldecode(http_build_query($this->params)));

        return $this;
    }
}
