<?php

namespace EightPoints\Bundle\GuzzleBundle\Events;

use Psr\Http\Message\RequestInterface;

class PreTransactionEvent extends Event
{
    /** @var \Psr\Http\Message\RequestInterface */
    protected $requestTransaction;

    /** @var string */
    protected $serviceName;

    /**
     * @param \Psr\Http\Message\RequestInterface $requestTransaction
     * @param string $serviceName
     */
    public function __construct(RequestInterface $requestTransaction, string $serviceName)
    {
        $this->requestTransaction = $requestTransaction;
        $this->serviceName = $serviceName;
    }

    /**
     * Access the transaction from the Guzzle HTTP request
     *
     * This returns the actual Request Object from the Guzzle HTTP Request.
     * This object will be modified by the event listener.
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function getTransaction() : RequestInterface
    {
        return $this->requestTransaction;
    }

    /**
     * Replaces the transaction with the modified one.
     *
     * Guzzles transaction returns a modified request object,
     * so once it has been modified, we need to put it back on the
     * event so it can become part of the transaction.
     *
     * @param \Psr\Http\Message\RequestInterface $requestTransaction
     *
     * @return void
     */
    public function setTransaction(RequestInterface $requestTransaction)
    {
        $this->requestTransaction = $requestTransaction;
    }

    /**
     * @return string
     */
    public function getServiceName() : string
    {
        return $this->serviceName;
    }
}
