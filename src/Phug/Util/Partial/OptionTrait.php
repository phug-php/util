<?php

namespace Phug\Util\Partial;

use ArrayObject;
use Traversable;

/**
 * Class OptionTrait.
 */
trait OptionTrait
{
    /**
     * @var ArrayObject
     */
    protected $options = null;

    /**
     * @var array
     */
    private $optionNameHandlers = [];

    /**
     * @param string $name
     *
     * @return string
     */
    private function handleOptionName($name)
    {
        if (is_array($name)) {
            $name = implode('.', $name);
        }

        foreach ($this->optionNameHandlers as $handler) {
            $name = $handler($name);
        }

        return $name;
    }

    private function filterTraversable($values)
    {
        return array_filter($values, function ($value) {
            return is_array($value) || $value instanceof Traversable;
        });
    }

    /**
     * @param array  $arrays
     * @param string $functionName
     *
     * @return $this
     */
    private function setOptionArrays(array $arrays, $functionName)
    {
        if (count($arrays) && !$this->options) {
            $this->options = $arrays[0] instanceof ArrayObject ? $arrays[0] : new ArrayObject($arrays[0]);
        }

        $options = $this->getOptions();
        foreach ($this->filterTraversable($arrays) as $array) {
            foreach ($array as $key => $value) {
                $options[$key] = isset($options[$key]) && is_array($options[$key]) && is_array($value)
                    ? $functionName($options[$key], $value)
                    : $value;
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getOptions()
    {
        if (!$this->options) {
            $this->options = new ArrayObject();
        }

        return $this->options;
    }

    /**
     * {@inheritdoc}
     */
    public function setOptions($options)
    {
        return $this->setOptionArrays(func_get_args(), 'array_replace');
    }

    /**
     * {@inheritdoc}
     */
    public function setOptionsRecursive($options)
    {
        return $this->setOptionArrays(func_get_args(), 'array_replace_recursive');
    }

    private function setDefaultOption($key, $value)
    {
        if (!$this->hasOption($key)) {
            $this->setOption($key, $value);
        } elseif (is_array($option = $this->getOption($key)) &&
            (!count($option) || is_string(key($option))) && is_array($value)
        ) {
            $this->setOption($key, array_replace_recursive($value, $this->getOption($key)));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setOptionsDefaults($options = null)
    {
        $first = $options && !$this->options;
        if ($first) {
            $this->options = $options instanceof ArrayObject ? $options : new ArrayObject($options);
        }
        foreach ($this->filterTraversable(array_slice(func_get_args(), $first ? 1 : 0)) as $array) {
            foreach ($array as $key => $value) {
                $this->setDefaultOption($key, $value);
            }
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function hasOption($name)
    {
        return array_key_exists($this->handleOptionName($name), $this->getOptions());
    }

    /**
     * {@inheritdoc}
     */
    public function getOption($name)
    {
        return $this->getOptions()[$this->handleOptionName($name)];
    }

    /**
     * {@inheritdoc}
     */
    public function setOption($name, $value)
    {
        $this->getOptions()[$this->handleOptionName($name)] = $value;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function unsetOption($name)
    {
        unset($this->getOptions()[$this->handleOptionName($name)]);

        return $this;
    }

    /**
     * @param callable $handler
     */
    public function addOptionNameHandlers($handler)
    {
        $this->optionNameHandlers[] = $handler;
    }
}
