<?php

namespace Phug\Util;

use InvalidArgumentException;

/**
 * Class UnorderedArguments
 *
 * @package Phug\Util
 */
class UnorderedArguments
{

    /**
     * @var
     */
    protected $arguments;

    /**
     * UnorderedArguments constructor.
     *
     * @param array $arguments
     */
    public function __construct(array $arguments)
    {
        $this->arguments = $arguments;
    }

    /**
     * @param $type
     *
     * @return mixed
     */
    public function optional($type)
    {
        foreach ($this->arguments as $index => $argument) {
            if (gettype($argument) === $type || is_a($argument, $type)) {
                array_splice($this->arguments, $index, 1);

                return $argument;
            }
        }
    }

    /**
     * @param $type
     *
     * @return mixed
     */
    public function required($type)
    {
        $count = count($this->arguments);
        $argument = $this->optional($type);
        if ($count === count($this->arguments)) {
            throw new InvalidArgumentException('Arguments miss one of the '.$type.' type');
        }

        return $argument;
    }

    /**
     *
     */
    public function noMoreArguments()
    {
        if ($count = count($this->arguments)) {
            throw new InvalidArgumentException('You pass '.$count.' unexpected arguments');
        }
    }

    /**
     *
     */
    public function noMoreDefinedArguments()
    {
        $definedArguments = array_filter($this->arguments, function ($argument) {
            return !is_null($argument);
        });

        if ($count = count($definedArguments)) {
            throw new InvalidArgumentException('You pass '.$count.' unexpected not null arguments');
        }
    }
}
