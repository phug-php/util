<?php

namespace Phug\Util\Partial;

/**
 * Class ValueTrait.
 */
trait ValueTrait
{
    /**
     * @var mixed
     */
    private $value = null;

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
