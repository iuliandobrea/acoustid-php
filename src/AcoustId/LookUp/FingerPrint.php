<?php namespace AcoustId\LookUp;

use AcoustId\LookUp;

/**
 * Class FingerPrint
 *
 * @package AcoustId\LookUp
 */
class FingerPrint extends LookUp
{

    /**
     * Duration of the whole audio file in seconds
     *
     * @required yes
     * @var int
     */
    protected $duration;

    /**
     * Audio fingerprint data to search for
     *
     * @required yes
     * @var string
     */
    protected $fingerPrint;

    /**
     * Array of required parameters for request
     *
     * @var array
     */
    protected $requiredParameters = [
        'duration', 'fingerPrint',
    ];

    /**
     * FingerPrint constructor.
     *
     * @param $duration
     * @param $fingerPrint
     */
    public function __construct($duration, $fingerPrint)
    {
        $this->setDuration($duration);
        $this->setFingerPrint($fingerPrint);
    }

    /**
     * Set search duration
     *
     * @param int $duration
     *
     * @return $this
     */
    public function setDuration($duration)
    {
        $this->duration = (int) $duration;

        return $this;
    }

    /**
     * Set search fingerprint
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
     * Get Search duration
     *
     * @return int
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Get search fingerprint
     *
     * @return string
     */
    public function getFingerPrint()
    {
        return $this->fingerPrint;
    }
}