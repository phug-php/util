<?php

namespace Phug\Util\Partial;

trait OptionTrait
{

    private $options = [];

    public function getOptions()
    {

        return $this->options;
    }

    public function setOptions(array $options, $recursive = false)
    {

        $fn = 'array_replace'.($recursive ? '_recursive' : '');

        $this->options = $fn($this->options, $options);

        return $this;
    }

    public function getOption($name)
    {

        return $this->options[$name];
    }

    public function setOption($name, $value)
    {

        $this->options[$name] = $value;

        return $this;
    }
}
