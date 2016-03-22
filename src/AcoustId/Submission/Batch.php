<?php namespace AcoustId\Submission;

use AcoustId\Submission;

class Batch extends Submission
{

    /**
     * Duration of the whole audio file in seconds
     *
     * @required yes
     * @var array
     */
    protected $duration;

    /**
     * Audio fingerprint data
     *
     * @required yes
     * @var array
     */
    protected $fingerPrint;

    public function __construct($userId, $duration, $fingerPrint)
    {
        # Use get_class($this) to drive the way of setting the vars
        parent::__construct($userId, $duration, $fingerPrint);
    }

}