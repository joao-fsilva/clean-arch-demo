<?php

namespace Demo\Domain\_Common\Exception;

use DomainException;

class EntityNotFoundException extends DomainException
{
    private array $errors;

    public function __construct(string $entity)
    {
        parent::__construct("$entity not found");

    }

    public function errors(): array
    {
        return $this->errors;
    }
}
