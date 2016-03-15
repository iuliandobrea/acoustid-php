<?php namespace AcoustId\Request;

use AcoustId\Request;

class Submission extends Request
{

    /**
     * @var \AcoustId\Submission
     */
    protected $instance;

    /**
     * Submission constructor.
     *
     * @param \AcoustId\Submission $instance
     */
    public function __construct($instance)
    {
        parent::__construct($instance);
    }

    /**
     * Create request url
     *
     * @return $this
     */
    public function createRequest()
    {
        $this->setUrl($this->instance->getUrl());

        $this->params['client']      = $this->instance->getClientId();
        $this->params['user']        = $this->instance->getUser();
        $this->params['duration']    = $this->instance->getDuration();
        $this->params['fingerprint'] = $this->instance->getFingerPrint();

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