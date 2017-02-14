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
     * @return boolean
     */
    public function hasStaticValue()
    {
        if (is_string($this->value)) {
            $tokens = token_get_all('<?php '.$this->value);
            return
                count($tokens) === 2 &&
                is_array($tokens[1]) &&
                in_array($tokens[1][0], [T_CONSTANT_ENCAPSED_STRING, T_DNUMBER, T_LNUMBER]);
        }

        return false;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
