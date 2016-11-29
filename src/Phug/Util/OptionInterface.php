<?php

namespace Phug\Util;

interface OptionInterface
{

    public function getOptions();
    public function setOptions(array $options, $recursive = false);
    public function getOption($name);
    public function setOption($name, $value);
}
