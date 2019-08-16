<?php

namespace AcoustId;

use AcoustId\Exceptions\HttpException;
use AcoustId\Exceptions\InvalidArgumentException;
use GuzzleHttp\Exception\ClientException;

/**
 * Class ListByMBId
 *
 * @package AcoustId
 */
class ListByMBId extends AcoustId
{

    /**
     * @var string
     */
    protected $MBId;

    /**
     * @var string
     */
    protected $apiUrl = 'https://api.acoustid.org/v2/track/list_by_mbid';

    /**
     * @param string $MBId
     *
     * @return $this
     * @throws InvalidArgumentException
     */
    public function setMBId(string $MBId)
    {
        if (empty($MBId)) {
            throw new InvalidArgumentException('MusicBrainz recording ID can not be empty.');
        }

        $this->MBId = $MBId;

        return $this;
    }

    /**
     * @return string
     */
    public function getMBId(): string
    {
        return $this->MBId;
    }

    /**
     * @param string $MBId
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws HttpException
     * @throws InvalidArgumentException
     */
    public function search($MBId)
    {
        $this->setMBId($MBId);

        try {
            $request = new Request\ListByMBId($this);

            return $request->send();
        } catch (ClientException $exception) {
            throw new HttpException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}
