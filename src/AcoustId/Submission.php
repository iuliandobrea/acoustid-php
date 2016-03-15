<?php namespace AcoustId;

use AcoustId\Traits\CheckRequiredParameters;

/**
 * Class Submission
 *
 * @package AcoustId
 */
class Submission
{

    use CheckRequiredParameters;

    /**
     * Response format.
     * Possible values are: $formatAllowedValues
     *
     * @required no
     * @var string
     */
    protected $format = 'json';

    /**
     * Allowed $format values.
     *
     * @var array
     */
    private $formatAllowedValues = ['json', 'xml'];

    /**
     * Application's API key
     *
     * @required yes
     * @var string
     */
    protected $clientId;

    /**
     * application's version
     *
     * @required no
     * @var string
     */
    protected $clientVersion = '1.0';

    /**
     * Wait up to N seconds for the submission(s) to import
     *
     * @required no
     * @var int
     */
    protected $wait;

    /**
     * Users's API key
     *
     * @required yes
     * @var string
     */
    protected $user;

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
    protected $mbid;

    /**
     * Track title
     *
     * @required no
     * @var string
     */
    protected $track;

    /**
     * Track artist
     *
     * @required no
     * @var string
     */
    protected $artist;

    /**
     * Album title
     *
     * @required no
     * @var string
     */
    protected $album;

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
    protected $year;

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
     * Array of required parameters for request
     *
     * @var array
     */
    protected $requiredParameters = [
        'user', 'duration', 'fingerPrint',
    ];

    /**
     * Request url
     *
     * @var string
     */
    protected $url = 'http://api.acoustid.org/v2/submit';

    /**
     * Submission constructor.
     *
     * @param string $userId
     * @param int    $duration
     * @param string $fingerPrint
     */
    public function __construct($userId, $duration, $fingerPrint)
    {
        $this->setUser($userId);
        $this->setDuration($duration);
        $this->setFingerPrint($fingerPrint);
    }

    /**
     * Set response format
     *
     * @param string $format
     *
     * @return $this
     * @throws Exception
     */
    public function setFormat($format)
    {
        if (!in_array($format, $this->formatAllowedValues)) {
            throw new Exception('Passed $format value is not in list of allowed values. Allowed: ' . join(', ', $this->formatAllowedValues));
        }

        $this->format = (string) $format;

        return $this;
    }

    /**
     * Set client id
     *
     * @param string $clientId
     *
     * @return $this
     */
    public function setClientId($clientId)
    {
        $this->clientId = (string) $clientId;

        return $this;
    }

    /**
     * Set client version
     *
     * @param string $clientVersion
     *
     * @return $this
     */
    public function setClientVersion($clientVersion)
    {
        $this->clientVersion = (string) $clientVersion;

        return $this;
    }

    /**
     * Set time to wait for submission to pass
     *
     * @param int $wait
     *
     * @return $this
     */
    public function setWait($wait)
    {
        $this->wait = (int) $wait;

        return $this;
    }

    /**
     * Set the user id parameter for request
     *
     * @param string $userId
     *
     * @return $this
     */
    public function setUser($userId)
    {
        $this->user = (string) $userId;

        return $this;
    }

    /**
     * Set duration
     *
     * @param  int $duration
     *
     * @return $this
     */
    public function setDuration($duration)
    {
        $this->duration = (int) $duration;

        return $this;
    }

    /**
     * Set fingerprint obtained from fpcalc utility
     *
     * @param string $fingerPrint
     *
     * @return $this
     */
    public function setFingerPrint($fingerPrint)
    {
        $this->fingerPrint = (string) $fingerPrint;

        return $this;
    }

    /**
     * Set bit rate of track
     *
     * @param int $bitrate
     *
     * @return $this
     */
    public function setBitRate($bitrate)
    {
        $this->bitrate = (int) $bitrate;

        return $this;
    }

    /**
     * Set file format
     *
     * @param string $fileFormat
     *
     * @return $this
     */
    public function setFileFormat($fileFormat)
    {
        $this->fileFormat = (string) $fileFormat;

        return $this;
    }

    /**
     * Set MusicBrainz id for track
     *
     * @param string $mbid
     *
     * @return $this
     */
    public function setMBID($mbid)
    {
        $this->mbid = (string) $mbid;

        return $this;
    }

    /**
     * Set track
     *
     * @param string $track
     *
     * @return $this
     */
    public function setTrack($track)
    {
        $this->track = (string) $track;

        return $this;
    }

    /**
     * Set artist
     *
     * @param string $artist
     *
     * @return $this
     */
    public function setArtist($artist)
    {
        $this->artist = (string) $artist;

        return $this;
    }

    /**
     * Set album
     *
     * @param string $album
     *
     * @return $this
     */
    public function setAlbum($album)
    {
        $this->album = (string) $album;

        return $this;
    }

    /**
     * Set album artist
     *
     * @param string $albumArtist
     *
     * @return $this
     */
    public function setAlbumArtist($albumArtist)
    {
        $this->albumArtist = (string) $albumArtist;

        return $this;
    }

    /**
     * Set year
     *
     * @param  int $year
     *
     * @return $this
     */
    public function setYear($year)
    {
        $this->year = (int) $year;

        return $this;
    }

    /**
     * Set track no
     *
     * @param int $trackNo
     *
     * @return $this
     */
    public function setTrackNo($trackNo)
    {
        $this->trackNo = (int) $trackNo;

        return $this;
    }

    /**
     * Set disc no
     *
     * @param int $discNo
     *
     * @return $this
     */
    public function setDiscNo($discNo)
    {
        $this->discNo = (int) $discNo;

        return $this;
    }

    /**
     * Get format
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Get client id
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Get client version
     *
     * @return string
     */
    public function getClientVersion()
    {
        return $this->clientVersion;
    }

    /**
     * Get wait timeout
     *
     * @return int
     */
    public function getWait()
    {
        return $this->wait;
    }

    /**
     * Get user id token
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get request url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Get duration
     *
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Get fingerprint
     *
     * @return string
     */
    public function getFingerPrint()
    {
        return $this->fingerPrint;
    }

    /**
     * Get bitrate
     *
     * @return int
     */
    public function getBitRate()
    {
        return $this->bitrate;
    }

    /**
     * Get file format
     *
     * @return string
     */
    public function getFileFormat()
    {
        return $this->fileFormat;
    }

    /**
     * Get  MusicBrainz id
     *
     * @return string
     */
    public function getMBID()
    {
        return $this->mbid;
    }

    /**
     * Get track
     *
     * @return string
     */
    public function getTrack()
    {
        return $this->track;
    }

    /**
     * Get artist
     *
     * @return string
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * Get album
     *
     * @return string
     */
    public function getAlbum()
    {
        return $this->album;
    }

    /**
     * Get album artist
     *
     * @return string
     */
    public function getAlbumArtist()
    {
        return $this->albumArtist;
    }

    /**
     * Get year
     *
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Get track no
     *
     * @return int
     */
    public function getTrackNo()
    {
        return $this->trackNo;
    }

    /**
     * Get disc no
     *
     * @return int
     */
    public function getDiscNo()
    {
        return $this->discNo;
    }

    /**
     * Get allowed format values
     *
     * @return array
     */
    public function getFormatAllowedValues()
    {
        return $this->formatAllowedValues;
    }
}

