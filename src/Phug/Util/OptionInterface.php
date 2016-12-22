<?php

namespace Phug\Util;

/**
 * Interface OptionInterface
 * @package Phug\Util
 */
interface OptionInterface
{

    /**
     * @return array
     */
    public function getOptions();

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions(array $options);

    /**
     * @param array $options
     * @return $this
     */
    public function setOptionsRecursive(array $options);

    /**
     * @param string $name
     * @return mixed
     */
    public function getOption($name);

    /**
     * @param string $name
     * @param mixed $value
     * @return $this
     */
    public function setOption($name, $value);

    /**
     * @param string $name
     * @return $this
     */
    public function unsetOption($name);
}
