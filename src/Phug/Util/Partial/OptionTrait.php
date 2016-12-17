<?php

namespace Phug\Util\Partial;

/**
 * Class OptionTrait
 * @package Phug\Util\Partial
 */
trait OptionTrait
{

    /**
     * @var array
     */
    private $options = [];

    /**
     * @param array  $arrays
     * @param string $functionName
     *
     * @return $this
     */
    private function setOptionArrays(array $arrays, $functionName)
    {

        array_unshift($arrays, $this->options);
        $this->options = call_user_func_array($functionName, array_filter($arrays, 'is_array'));

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getOptions()
    {

        return $this->options;
    }

    /**
     * {@inheritDoc}
     */
    public function setOptions(array $options)
    {

        return $this->setOptionArrays(func_get_args(), 'array_replace');
    }

    /**
     * {@inheritdoc}
     */
    public function setOptionsRecursive(array $options)
    {

        return $this->setOptionArrays(func_get_args(), 'array_replace_recursive');
    }

    /**
     * {@inheritdoc}
     */
    public function getOption($name)
    {

        return $this->options[$name];
    }

    /**
     * {@inheritdoc}
     */
    public function setOption($name, $value)
    {

        $this->options[$name] = $value;

        return $this;
    }
}
