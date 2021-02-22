<?php


namespace Ernestblaz\API\Model;


class ReturnSuccess implements \Ernestblaz\API\Api\Data\ReturnSuccessInterface
{
    private $success;

    public function getSuccess()
    {
        return $this->success;
    }

    public function setSuccess($success)
    {
        return $this->success = $success;
    }
}
