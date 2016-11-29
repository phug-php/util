<?php

namespace Phug\Util;

interface OptionInterface
{

    public function getOptions();
    public function setOptions(array $options);
    public function setOptionsRecursive(array $options);
    public function getOption($name);
    public function setOption($name, $value);
}
