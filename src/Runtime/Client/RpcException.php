<?php

namespace Chiphpotle\Rest\Runtime\Client;

use Chiphpotle\Rest\Model\RpcStatus;

/**
 * Wrapper around RpcStatus
 */
final class RpcException extends \RuntimeException
{
    public function __construct(RpcStatus $rpcStatus)
    {
        $details = $rpcStatus->getDetails();
        $detailStr = $details === [] ? '' : ' details: ' . json_encode($details, JSON_PRETTY_PRINT);
        $message = "Rpc Error {$rpcStatus->getCode()} {$rpcStatus->getMessage()}$detailStr";
        parent::__construct($message, $rpcStatus->getCode());
    }
}
