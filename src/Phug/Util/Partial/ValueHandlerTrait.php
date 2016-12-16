<?php

namespace Phug\Util\Partial;

trait ValueHandlerTrait
{

    use ValueTrait;

    public function __construct($value)
    {
        $this->setValue($value);
    }
}