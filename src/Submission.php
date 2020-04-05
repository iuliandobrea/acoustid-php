<?php

namespace AcoustId;


use AcoustId\Exceptions\BadMethodCallException;
use AcoustId\Exceptions\HttpException;
use AcoustId\Exceptions\InvalidArgumentException;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Submission
 *
 * @package AcoustId
 */
class Submission extends AcoustId
{

    /**
     * Wait up to N seconds for the submission(s) to import
     *
     * @required no
     * @var int
     */
    protected $wait;

    /**
     * Users's API key for making submit requests
     *
     * @var string
     */
    protected $userToken;

    /**
     * Duration of the whole audio file in seconds
     *
     * @required yes
     * @var int
     */
    protected $duration;

    /**
     * Audio fingerprint data
     *
     * @required yes
     * @var string
     */
    protected $fingerPrint;

    /**
     * Bitrate of the audio file
     *
     * @required no
     * @var int
     */
    protected $bitrate;

    /**
     * File format of the audio file
     *
     * @required no
     * @var string
     */
    protected $fileFormat;

    /**
     * Corresponding MusicBrainz track ID
     *
     * @required no
     * @var string
     */
    protected $mbTrackId;

    /**
     * Track title
     *
     * @required no
     * @var string
     */
    protected $trackTitle;

    /**
     * Track artist
     *
     * @required no
     * @var string
     */
    protected $trackArtist;

    /**
     * Album title
     *
     * @required no
     * @var string
     */
    protected $albumTitle;

    /**
     * Album artist
     *
     * @required no
     * @var string
     */
    protected $albumArtist;

    /**
     * Album release year
     *
     * @required no
     * @var int
     */
    protected $albumReleaseYear;

    /**
     * Track number
     *
     * @required no
     * @var int
     */
    protected $trackNo;

    /**
     * Disc number
     *
     * @required no
     * @var int
     */
    protected $discNo;


    /**
     * Request url
     *
     * @var string
     */
    protected $apiUrl = 'https://api.acoustid.org/v2/submit';

    /**
     * Submission constructor.
     *
     * @param string $token
     *
     * @throws Exceptions\UnexpectedValueException
     */
    public function __construct(string $token)
    {
        parent::__construct($token);
    }

    /**
     * @return \Psr\Http\Message\ResponseInterface
     * @throws Exceptions\UnexpectedValueException
     * @throws HttpException
     */
    public function send()
    {
        try {
            $request = new \AcoustId\Request\Submit($this);

            return $request->send();
        } catch (ClientException $exception) {
            throw new HttpException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * @param string $callback
     *
     * @return AcoustId|void
     * @throws BadMethodCallException
     */
    public function setJSONPResponseType(string $callback = 'jsonAcoustidApi')
    {
        throw new BadMethodCallException('JSONP response type is unavailable for submit requests.');
    }

    /**
     * @param int $wait
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setWait(int $wait): self
    {
        if (empty($wait)) {
            throw new InvalidArgumentException('Wait parameter can not be empty.');
        }

        if ($wait <= 0) {
            throw new InvalidArgumentException('Wait must be positive integer. ' . $wait . ' given.');
        }

        $this->wait = (int) $wait;

        return $this;
    }

    /**
     * @param int $duration
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setDuration(int $duration): self
    {
        if (empty($duration)) {
            throw new InvalidArgumentException('Duration property can not be empty.');
        }

        if ($duration <= 0) {
            throw new InvalidArgumentException('Duration must be positive integer. ' . $duration . ' given.');
        }

        $this->duration = (int) $duration;

        return $this;
    }

    /**
     * @param string $fingerPrint
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setFingerPrint(string $fingerPrint): self
    {
        if (empty($fingerPrint)) {
            throw new InvalidArgumentException('FingerPrint can not be empty.');
        }

        $this->fingerPrint = $fingerPrint;

        return $this;
    }

    /**
     * @param int $bitrate
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setBitRate(int $bitrate): self
    {
        if ($bitrate <= 0) {
            throw new InvalidArgumentException('BitRate must be positive integer. ' . $bitrate . ' given.');
        }

        $this->bitrate = $bitrate;

        return $this;
    }

    /**
     * @param string $fileFormat
     *
     * @return $this
     */
    public function setFileFormat(string $fileFormat): self
    {
        $this->fileFormat = $fileFormat;

        return $this;
    }

    /**
     * @param string $mbTrackId
     *
     * @return $this
     */
    public function setMbTrackId(string $mbTrackId): self
    {
        $this->mbTrackId = $mbTrackId;

        return $this;
    }

    /**
     * @param string $trackTitle
     *
     * @return $this
     */
    public function setTrackTitle(string $trackTitle): self
    {
        $this->trackTitle = $trackTitle;

        return $this;
    }

    /**
     * @param string $trackArtist
     *
     * @return $this
     */
    public function setTrackArtist(string $trackArtist): self
    {
        $this->trackArtist = $trackArtist;

        return $this;
    }

    /**
     * @param string $albumTitle
     *
     * @return $this
     */
    public function setAlbumTitle(string $albumTitle): self
    {
        $this->albumTitle = $albumTitle;

        return $this;
    }

    /**
     * @param string $albumArtist
     *
     * @return $this
     */
    public function setAlbumArtist(string $albumArtist): self
    {
        $this->albumArtist = $albumArtist;

        return $this;
    }

    /**
     * @param int $albumReleaseYear
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setAlbumReleaseYear(int $albumReleaseYear): self
    {
        if ($albumReleaseYear <= 0) {
            throw new InvalidArgumentException('Album release year must be positive integer. ' . $albumReleaseYear . ' given.');
        }

        $this->albumReleaseYear = $albumReleaseYear;

        return $this;
    }

    /**
     * @param int $trackNo
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setTrackNo(int $trackNo): self
    {
        if ($trackNo <= 0) {
            throw new InvalidArgumentException('Track number must be positive integer. ' . $trackNo . ' given.');
        }

        $this->trackNo = $trackNo;

        return $this;
    }

    /**
     * @param int $discNo
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setDiscNo(int $discNo): self
    {
        if ($discNo <= 0) {
            throw new InvalidArgumentException('Disk number must be positive integer. ' . $discNo . ' given.');
        }

        $this->discNo = $discNo;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getWait(): ?int
    {
        return $this->wait ?? 1;
    }

    /**
     * @return int|null
     */
    public function getDuration(): ?int
    {
        return $this->duration;
    }

    /**
     * @return string
     */
    public function getFingerPrint(): string
    {
        return $this->fingerPrint;
    }

    /**
     * @return int|null
     */
    public function getBitRate(): ?int
    {
        return $this->bitrate;
    }

    /**
     * @return string|null
     */
    public function getFileFormat(): ?string
    {
        return $this->fileFormat;
    }

    /**
     * @return string|null
     */
    public function getMbTrackId(): ?string
    {
        return $this->mbTrackId;
    }

    /**
     * @return string|null
     */
    public function getTrackTitle(): ?string
    {
        return $this->trackTitle;
    }

    /**
     * @return string|null
     */
    public function getTrackArtist(): ?string
    {
        return $this->trackArtist;
    }

    /**
     * @return string|null
     */
    public function getAlbumTitle(): ?string
    {
        return $this->albumTitle;
    }

    /**
     * @return string|null
     */
    public function getAlbumArtist(): ?string
    {
        return $this->albumArtist;
    }

    /**
     * @return int|null
     */
    public function getAlbumReleaseYear(): ?int
    {
        return $this->albumReleaseYear;
    }

    /**
     * @return int|null
     */
    public function getTrackNo(): ?int
    {
        return $this->trackNo;
    }

    /**
     * @return int|null
     */
    public function getDiscNo(): ?int
    {
        return $this->discNo;
    }

    /**
     * @return string|null
     */
    public function getUserToken(): ?string
    {
        return $this->userToken;
    }

    /**
     * @param string $userToken
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setUserToken(string $userToken): self
    {
        if (empty($userToken)) {
            throw new InvalidArgumentException('User\'s API token can not be empty. We need one for sending submit requests.');
        }

        $this->userToken = $userToken;

        return $this;
    }

}

