<?php

namespace Phug\Util\Partial;

trait OptionTrait
{

    private $options = [];

    public function setOptionsArrays(array $optionsArrays, $method = 'array_replace')
    {

        $optionsArrays = array_filter($optionsArrays, 'is_array');
        array_unshift($optionsArrays, $this->options);
        $this->options = call_user_func_array($method, $optionsArrays);

        return $this;
    }

    public function getOptions()
    {

        return $this->options;
    }

    public function setOptions(array $options)
    {

        return $this->setOptionsArrays(func_get_args());
    }

    public function setOptionsRecursive(array $options)
    {

        return $this->setOptionsArrays(func_get_args(), 'array_replace_recursive');
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
