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
    protected $options = [];

    /**
     * @param array $arrays
     * @param string $fn
     * @return $this
     */
    private function setOptionArrays(array $arrays, $fn)
    {

        foreach ($arrays as $array) {
            if (!is_array($array)) {
                continue;
            }

            $this->options = $fn($this->options, $array);
        }

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
