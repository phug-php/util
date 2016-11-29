<?php

namespace Phug\Util\Partial;

trait SubjectTrait
{

    private $subject = null;

    public function getSubject()
    {

        return $this->subject;
    }

    public function setSubject($subject)
    {

        $this->subject = $subject;

        return $this;
    }
}
