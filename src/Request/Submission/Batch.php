<?php

namespace AcoustId\Request\Submission;

use AcoustId\Exceptions\InvalidArgumentException;
use AcoustId\Exceptions\UnexpectedValueException;
use AcoustId\Request;
use AcoustId\Submission;

/**
 * Class Batch
 *
 * @package AcoustId\Request\Submission
 */
class Batch extends Request
{

    /**
     * @var Submission\Batch
     */
    protected $batch;

    /**
     * @var array
     */
    protected $queryParams;

    /**
     * Batch constructor.
     *
     * @param Submission\Batch $batch
     *
     * @throws InvalidArgumentException
     * @throws UnexpectedValueException
     */
    public function __construct(\AcoustId\Submission\Batch $batch)
    {
        parent::__construct($batch);

        $this->batch       = $batch;
        $classQueryParams  = $this->composeQueryParameters();
        $this->queryParams = $classQueryParams;

        $this->createFullQueryString($classQueryParams);
    }

    /**
     * @param \AcoustId\ListByMBId|\AcoustId\LookUp|Submission|Submission\Batch $submission
     *
     * @return array
     * @throws UnexpectedValueException
     */
    protected function createBaseQueryString($submission): array
    {
        $query = parent::createBaseQueryString($submission);

        $query['user'] = $submission->getUserToken();
        $query['wait'] = $submission->getWait();

        if (empty($query['user'])) {
            throw new UnexpectedValueException('User token must be filled before submitting data to AcoustId API.');
        }

        return $query;
    }

    /**
     * Override GET request to POST due to data length
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function doRequest()
    {
        return $this->requestClient->post($this->requestUrl, ['form_params' => $this->queryParams]);
    }

    /**
     * @return array
     * @throws InvalidArgumentException
     * @throws UnexpectedValueException
     */
    protected function composeQueryParameters(): array
    {
        $query = $this->createBaseQueryString($this->batch);

        if (empty($this->batch->getBatch())) {
            throw new InvalidArgumentException('Batch request data can not be empty.');
        }

        foreach ($this->batch->getBatch() as $key => $row) {
            /** @var Submission $row */
            $query['duration.' . $key]    = $row->getDuration();
            $query['fingerprint.' . $key] = $row->getFingerPrint();

            $query['bitrate.' . $key]     = $row->getBitRate();
            $query['fileformat.' . $key]  = $row->getFileFormat();
            $query['mbid.' . $key]        = $row->getMbTrackId();
            $query['track.' . $key]       = $row->getTrackTitle();
            $query['artist.' . $key]      = $row->getTrackArtist();
            $query['album.' . $key]       = $row->getAlbumTitle();
            $query['albumartist.' . $key] = $row->getAlbumArtist();
            $query['year.' . $key]        = $row->getAlbumReleaseYear();
            $query['trackno.' . $key]     = $row->getTrackNo();
            $query['discno.' . $key]      = $row->getDiscNo();

            if (empty($query['duration.' . $key])) {
                throw new UnexpectedValueException('Duration query parameter is mandatory for batch submit requests.');
            }

            if (empty($query['fingerprint.' . $key])) {
                throw new UnexpectedValueException('Fingerprint query parameter is mandatory for batch submit requests.');
            }

            # Clear non-used fields for valid API calls
            foreach ($query as $k => $row) {
                if (is_null($row)) {
                    unset($query[$k]);
                }
            }
        }

        return $query;
    }
}
