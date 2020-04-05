<?php

namespace AcoustId;

use AcoustId\Exceptions\InvalidArgumentException;
use AcoustId\Exceptions\UnexpectedValueException;

/**
 * Class LookUp
 *
 * @package AcoustId
 * @property array $requiredParameters
 */
abstract class LookUp extends AcoustId
{

    /**
     * Returned metadata.
     * Possible values are: $metaAllowedValues
     *
     * @required no
     * @var array
     */
    protected $metaData;

    /**
     * Allowed metadata values
     *
     * @var array
     */
    private $metaAllowedValues = [
        self::META_RECORDINGS,
        self::META_RECORDINGIDS,
        self::META_RELEASES,
        self::META_RELEASESIDS,
        self::META_RELEASEGROUPS,
        self::META_RELEASEGROUPIDS,
        self::META_TRACKS,
        self::META_COMPRESS,
        self::META_USERMETA,
        self::META_SOURCES,
    ];

    const META_RECORDINGS      = 'recordings';
    const META_RECORDINGIDS    = 'recordingids';
    const META_RELEASES        = 'releases';
    const META_RELEASESIDS     = 'releaseids';
    const META_RELEASEGROUPS   = 'releasegroups';
    const META_RELEASEGROUPIDS = 'releasegroupids';
    const META_TRACKS          = 'tracks';
    const META_COMPRESS        = 'compress';
    const META_USERMETA        = 'usermeta';
    const META_SOURCES         = 'sources';

    /**
     * AcoustId API base url.
     *
     * @var string
     */
    protected $apiUrl = 'https://api.acoustid.org/v2/lookup';

    /**
     * LookUp constructor.
     *
     * @param string $token
     *
     * @throws UnexpectedValueException
     */
    public function __construct(string $token)
    {
        parent::__construct($token);
    }

    /**
     * Set desired response meta
     *
     * @param array $metaData
     *
     * @return $this
     * @throws InvalidArgumentException
     * @throws UnexpectedValueException
     */
    public function setMetaData(array $metaData): self
    {
        if (empty($metaData)) {
            throw new InvalidArgumentException('$metaData parameter must be a non-empty array');
        }

        foreach ($metaData as $item) {
            if (!in_array($item, $this->metaAllowedValues)) {
                throw new UnexpectedValueException('Passed $metaData (' . $item . ') member is not in list of allowed values. Allowed: ' . join(', ', $this->metaAllowedValues));
            }

            $this->metaData[] = (string) $item;
        }

        return $this;
    }

    /**
     * @return array|null
     */
    public function getMetaData(): ?array
    {
        return $this->metaData;
    }

    /**
     * @return array
     */
    public function getMetaDataAllowedValues(): array
    {
        return $this->metaAllowedValues;
    }
}
