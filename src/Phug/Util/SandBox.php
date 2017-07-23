<?php

namespace Phug\Util;

use Exception;
use Throwable;

class SandBox
{
    /**
     * @var mixed
     */
    private $result;

    /**
     * @var Throwable
     */
    private $throwable;

    public function __construct(callable $action)
    {
        try {
            $this->result = $action();
        } /* @codeCoverageIgnoreStart */ catch (Throwable $throwable) { // PHP 7
            $this->throwable = $throwable;
        } catch (Exception $exception) { // PHP 5
            $this->throwable = $exception;
        }
        /* @codeCoverageIgnoreEnd */
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @return Throwable
     */
    public function getThrowable()
    {
        return $this->throwable;
    }
}
