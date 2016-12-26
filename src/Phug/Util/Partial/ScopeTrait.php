<?php

namespace Phug\Util\Partial;

/**
 * Class BlockTrait
 * @package Phug\Util\Partial
 */
trait ScopeTrait
{

    /**
     * @var string
     */
    private $scopeId = null;

    /**
     * {@inheritdoc}
     */
    public function setScope($object)
    {

        $this->scopeId = is_object($object) ? spl_object_hash($object) : null;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getScopeId()
    {

        return $this->scopeId;
    }
}
