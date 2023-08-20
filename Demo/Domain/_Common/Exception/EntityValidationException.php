<?php

namespace Demo\Domain\_Common\Exception;

use DomainException;

class EntityValidationException extends DomainException
{
    private array $errors;

    public function __construct(array $errors)
    {
        parent::__construct();

        $this->errors = $errors;
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
