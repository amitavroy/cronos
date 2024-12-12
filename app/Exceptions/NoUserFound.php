<?php

namespace App\Exceptions;

use Exception;

class NoUserFound extends Exception
{
    public function __construct(string $message = 'No user was found for the given criteria')
    {
        parent::__construct($message, 500);
    }
}
