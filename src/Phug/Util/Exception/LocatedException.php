<?php

namespace Phug\Util\Exception;

use Phug\Util\SourceLocation;

class LocatedException extends \Exception
{

    private $location;

    public function __construct(
        SourceLocation $location,
        $message = "",
        $code = 0,
        $previous = null
    ) {
    
        parent::__construct($message, $code, $previous);

        $this->location = $location;
    }

    /**
     * @return SourceLocation
     */
    public function getLocation()
    {
        return $this->location;
    }
}
