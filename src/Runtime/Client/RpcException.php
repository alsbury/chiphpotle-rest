<?php

namespace Chiphpotle\Rest\Runtime\Client;

use Chiphpotle\Rest\Model\RpcStatus;

/**
 * Wrapper around RpcStatus
 */
final class RpcException extends \RuntimeException
{
    private array $details;

    public function __construct(RpcStatus $rpcStatus)
    {
        parent::__construct($rpcStatus->getMessage(), $rpcStatus->getCode());
        $this->details = $rpcStatus->getDetails();
    }

    public function __toString(): string
    {
        $detailStr = !empty($this->details) ? ":\n" . json_encode($this->details, JSON_PRETTY_PRINT) : '';
        return "Rpc Error $this->code $this->message $detailStr";
    }
}
