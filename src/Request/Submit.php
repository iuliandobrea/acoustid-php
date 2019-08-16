<?php

namespace AcoustId\Request;

use AcoustId\Exceptions\UnexpectedValueException;
use AcoustId\Request;

/**
 * Class Submit
 *
 * @package AcoustId\Request
 */
class Submit extends Request
{
    /**
     * @var \AcoustId\Submission
     */
    protected $submission;

    /**
     * Submit constructor.
     *
     * @param \AcoustId\Submission $instance
     *
     * @throws UnexpectedValueException
     */
    public function __construct(\AcoustId\Submission $instance)
    {
        parent::__construct($instance);

        $this->submission = $instance;
        $classQueryParams = $this->composeQueryParameters();

        $this->createFullQueryString($classQueryParams);
    }

    /**
     * @param \AcoustId\Submission $submission
     *
     * @return array
     * @throws UnexpectedValueException
     */
    protected function createBaseQueryString($submission): array
    {
        $query = parent::createBaseQueryString($submission);

        $query['user'] = $submission->getUserToken();

        if (empty($query['user'])) {
            throw new UnexpectedValueException('User token must be filled before submitting data to AcoustId API.');
        }

        return $query;
    }

    /**
     * @return array
     * @throws UnexpectedValueException
     */
    protected function composeQueryParameters(): array
    {
        $query = $this->createBaseQueryString($this->submission);

        $query['duration']    = $this->submission->getDuration();
        $query['fingerprint'] = $this->submission->getFingerPrint();

        $query['wait']        = $this->submission->getWait();
        $query['bitrate']     = $this->submission->getBitRate();
        $query['fileformat']  = $this->submission->getFileFormat();
        $query['mbid']        = $this->submission->getMbTrackId();
        $query['track']       = $this->submission->getTrackTitle();
        $query['artist']      = $this->submission->getTrackArtist();
        $query['album']       = $this->submission->getAlbumTitle();
        $query['albumartist'] = $this->submission->getAlbumArtist();
        $query['year']        = $this->submission->getAlbumReleaseYear();
        $query['trackno']     = $this->submission->getTrackNo();
        $query['discno']      = $this->submission->getDiscNo();

        if (empty($query['duration'])) {
            throw new UnexpectedValueException('Duration query parameter is mandatory for submit requests.');
        }

        if (empty($query['fingerprint'])) {
            throw new UnexpectedValueException('Fingerprint query parameter is mandatory for submit requests.');
        }

        # Clear non-used fields for valid API calls
        foreach ($query as $k => $row) {
            if (is_null($row)) {
                unset($query[$k]);
            }
        }

        return $query;
    }
}