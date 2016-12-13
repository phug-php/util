<?php

namespace Phug\Util\Partial;

trait OptionTrait
{

    protected $options = [];

    public function getOptions()
    {

        return $this->options;
    }

    public function setOptions(array $options)
    {

        $this->options = array_replace($this->options, $options);

        return $this;
    }

    public function setOptionsRecursive(array $options)
    {

        $this->options = array_replace_recursive($this->options, $options);

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
