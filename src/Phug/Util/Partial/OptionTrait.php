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
     * @param array|string  $keys
     * @param callable      $callback
     *
     * @return &$options
     */
    private function withOptionsReference(&$keys, $callback)
    {
        $options = &$this->options;
        if (is_array($keys)) {
            foreach (array_slice($keys, 0, -1) as $key) {
                if (!array_key_exists($key, $options)) {
                    $options[$key] = [];
                }
                $options = &$options[$key];
            }
            $keys = end($keys);
        }

        return $callback($options, $keys);
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
    public function getOption($keys)
    {

        return $this->withOptionsReference($keys, function (&$options, $name) {
            return $options[$name];
        });
    }

    /**
     * {@inheritdoc}
     */
    public function setOption($keys, $value)
    {

        $this->withOptionsReference($keys, function (&$options, $name) use ($value) {
            $options[$name] = $value;
        });

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function unsetOption($keys)
    {

        $this->withOptionsReference($keys, function (&$options, $name) {
            unset($options[$name]);
        });

        return $this;
    }
}
