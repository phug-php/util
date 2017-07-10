<?php

namespace Phug\Util\Exception;

use Phug\Util\ExceptionLocation;

class LocatedException extends \Exception
{

    private $location;

    public function __construct(
        ExceptionLocation $location,
        $message = "",
        $code = 0,
        $previous = null
    ) {
    
        parent::__construct($message, $code, $previous);

        $this->location = $location;
    }

    /**
     * @return ExceptionLocation
     */
    public function getLocation()
    {
        return $this->location;
    }
}
