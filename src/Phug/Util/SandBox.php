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
     * @var string
     */
    private $buffer;

    /**
     * @var Throwable
     */
    private $throwable;

    public function __construct(callable $action)
    {
        ob_start();
        // @codeCoverageIgnoreStart
        try {
            $this->result = $action();
        } catch (Throwable $throwable) { // PHP 7
            $this->throwable = $throwable;
        } catch (Exception $exception) { // PHP 5
            $this->throwable = $exception;
        }
        // @codeCoverageIgnoreEnd
        $this->buffer = ob_get_contents();
        ob_end_clean();
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

    /**
     * @return string
     */
    public function getBuffer()
    {
        return $this->buffer;
    }

    public function outputBuffer()
    {
        echo $this->buffer;

        $this->buffer = '';
    }
}
