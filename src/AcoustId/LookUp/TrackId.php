<?php namespace AcoustId\LookUp;

use AcoustId\LookUp;

/**
 * Class TrackId
 *
 * @package AcoustId\LookUp
 */
class TrackId extends LookUp
{

    /**
     * Track id (UUID) to search for
     *
     * @required yes
     * @var string
     */
    protected $trackId;

    /**
     * Array of required parameters for request
     *
     * @var array
     */
    protected $requiredParameters = [
        'trackId',
    ];

    /**
     * TrackId constructor.
     *
     * @param $trackId
     */
    public function __construct($trackId)
    {
        $this->setTrackId($trackId);
    }

    /**
     * Set track id
     *
     * @param string $trackId
     *
     * @return $this
     */
    public function setTrackId($trackId)
    {
        $this->trackId = (string) $trackId;

        return $this;
    }

    /**
     * Get track id
     *
     * @return string
     */
    public function getTrackId()
    {
        return $this->trackId;
    }
}