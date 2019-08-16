<?php

namespace AcoustId\Request\Submission;

use AcoustId\Exceptions\UnexpectedValueException;
use AcoustId\Request;

/**
 * Class Status
 *
 * @package AcoustId\Request\Submission
 */
class Status extends Request
{
    /**
     * @var \AcoustId\Submission\Status
     */
    protected $status;

    /**
     * Status constructor.
     *
     * @param \AcoustId\Submission\Status $instance
     *
     * @throws UnexpectedValueException
     */
    public function __construct(\AcoustId\Submission\Status $instance)
    {
        parent::__construct($instance);

        $this->status     = $instance;
        $classQueryParams = $this->composeQueryParameters();

        $this->createFullQueryString($classQueryParams);
    }

    /**
     * @param \AcoustId\LookUp|\AcoustId\Submission|\AcoustId\Submission\Status $instance
     *
     * @return array
     * @throws UnexpectedValueException
     */
    protected function createBaseQueryString($instance): array
    {
        $query['format'] = $instance->getResponseType();
        $query['client'] = $instance->getClientAPIToken();

        return $query;
    }

    /**
     * @return array
     * @throws UnexpectedValueException
     */
    protected function composeQueryParameters(): array
    {
        $query = $this->createBaseQueryString($this->status);

        $query['id'] = $this->status->getSubmissionId();

        if (empty($query['id'])) {
            throw new UnexpectedValueException('Submission id parameter is mandatory for submission status requests.');
        }

        return $query;
    }
}