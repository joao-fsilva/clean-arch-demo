<?php

namespace Demo\Domain\Entity;

class Customer extends Entity
{
    private string $name;

    public function __construct(string $name)
    {
        parent::__construct();

        $this->changeName($name);
        $this->throwExceptionIfHasErrors();
    }

    public function changeName(string $name): void
    {
        $length = mb_strlen($name);
        if ($length < 3 || $length > 255) {
            $this->notification->addError('name', 'name must be more than 3 and less than 255 characters.');
            return ;
        }

        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }
}
