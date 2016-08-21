<?php

namespace Wanimo\Mowlkky\CoreDomain\User;

use Exception;

class NotUniqueEmailException extends \Exception
{
    public function __construct($email, $code = 0, Exception $previous = null)
    {
        parent::__construct(sprintf('There is already another registered user with email %s', $email), $code, $previous);
    }
}
