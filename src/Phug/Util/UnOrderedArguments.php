<?php

namespace Phug\Util;

use InvalidArgumentException;

class UnOrderedArguments
{

    protected $arguments;

    public function __construct($arguments)
    {
        $this->arguments = $arguments;
    }

    public function optional($type)
    {
        foreach ($this->arguments as $index => $argument) {
            if (gettype($argument) === $type || is_a($argument, $type)) {
                array_splice($this->arguments, $index, 1);

                return $argument;
            }
        }
    }

    public function required($type)
    {
        $count = count($this->arguments);
        $argument = $this->optional($type);
        if ($count === count($this->arguments)) {
            throw new InvalidArgumentException('Arguments miss one of the '.$type.' type');
        }

        return $argument;
    }

    public function noMoreArguments()
    {
        if ($count = count($this->arguments)) {
            throw new InvalidArgumentException('You pass '.$count.' unexpected arguments');
        }
    }
}
