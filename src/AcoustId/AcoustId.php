<?php namespace AcoustId;

use AcoustId\LookUp\FingerPrint;
use AcoustId\LookUp\TrackId;
use AcoustId\Request\ListByMBID;
use AcoustId\Request\LookUp as RequestLookUp;
use AcoustId\Request\Submission\Status as RequestSubmissionStatus;
use AcoustId\Request\Submission as RequestSubmission;
use AcoustId\Submission;
use AcoustId\Submission\Status;

class AcoustId
{

    /**
     * API client key
     *
     * @var string
     */
    protected $clientId;

    public function __construct($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * Perform lookup and return response
     *
     * @param FingerPrint|TrackId $lookUp - API client key
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws Exception
     */
    public function lookUp($lookUp)
    {
        # Validate the type of $lookUp
        $this->checkLookUpType($lookUp);

        $lookUp->setClientId($this->clientId);
        $lookUp->checkRequiredParameters();

        return (new RequestLookUp($lookUp))->createRequest()->send();
    }

    /**
     * Create new submit request
     *
     * @param Submission $instance
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws Exception
     */
    public function submission($instance)
    {
        # Validate the type of $lookUp
        $this->checkSubmissionType($instance);

        $instance->setClientId($this->clientId);
        $instance->checkRequiredParameters();

        return (new RequestSubmission($instance))->createRequest()->send();
    }

    /**
     * @param Status $instance
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws Exception
     */
    public function submissionStatus($instance)
    {
        # Validate the type of $lookUp
        $this->checkSubmissionStatusType($instance);

        $instance->setClientId($this->clientId);
        $instance->checkRequiredParameters();

        return (new RequestSubmissionStatus($instance))->createRequest()->send();
    }

    /**
     * Create list request
     *
     * @param ListByMDID $instance
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws Exception
     */
    public function listByMBID($instance)
    {
        # Validate the type of $lookUp
        $this->checkListByMBIDStatusType($instance);

        $instance->setClientId($this->clientId);
        # Here we don't need ClientId, but use the generic way of class definition
        $instance->checkRequiredParameters(['url']);

        return (new ListByMBID($instance))->createRequest()->send();
    }

    /**
     * Check the $instance type
     *
     * @param \AcoustId\ListByMDID $instance
     *
     * @throws Exception
     */
    private function checkListByMBIDStatusType($instance)
    {
        if (!is_object($instance) or !in_array(get_class($instance), [ListByMDID::class])) {
            throw new Exception(__METHOD__ . '($instance): $instance provided must be an instance of: ' . ListByMDID::class . '. ' . ucfirst(gettype($instance)) . ' given.');
        }
    }

    /**
     * Validate the $instance type
     *
     * @param Status $instance
     *
     * @throws Exception
     */
    private function checkSubmissionStatusType($instance)
    {
        if (!is_object($instance) or !in_array(get_class($instance), [Status::class])) {
            throw new Exception(__METHOD__ . '($instance): $instance provided must be an instance of: ' . Status::class . '. ' . ucfirst(gettype($instance)) . ' given.');
        }
    }

    /**
     * Validate the $instance type
     *
     * @param Submission $instance
     *
     * @throws Exception
     */
    private function checkSubmissionType($instance)
    {
        if (!is_object($instance) or !in_array(get_class($instance), [Submission::class])) {
            throw new Exception(__METHOD__ . '($instance): $instance provided must be an instance of: ' . Submission::class . '. ' . ucfirst(gettype($instance)) . ' given.');
        }
    }

    /**
     * Validate the $lookUp type
     *
     * @param FingerPrint|TrackId $lookUp
     *
     * @throws Exception
     */
    private function checkLookUpType($lookUp)
    {
        if (!is_object($lookUp) or !in_array(get_class($lookUp), [FingerPrint::class, TrackId::class])) {
            throw new Exception(__METHOD__ . '($lookUp): $lookUp provided must be an instance of: ' . FingerPrint::class . ' or ' . TrackId::class . '. ' . ucfirst(gettype($lookUp)) . ' given.');
        }
    }
}