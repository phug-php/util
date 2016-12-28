<?php

namespace Phug\Util;

/**
 * Interface ScopeInterface.
 */
interface ScopeInterface
{
    /**
     * @param object $object
     *
     * @return $this
     */
    public function setOptions(array $options);

    /**
     * @return string
     */
    public function getOptions();
}
