<?php namespace AcoustId\Submission;

use AcoustId\Submission;

/**
 * Class Batch
 *
 * @package AcoustId\Submission
 */
class Batch extends Submission
{
    /**
     * Batch constructor.
     *
     * @param string       $userId
     * @param array|int    $duration
     * @param array|string $fingerPrint
     */
    public function __construct($userId, $duration, $fingerPrint)
    {
        # Use get_class($this) to drive the way of setting the vars
        parent::__construct($userId, $duration, $fingerPrint);
    }
}