<?php

namespace Demo\Domain\_Common\Notification;

class Notification
{
    private array $errors;

    public function __construct()
    {
        $this->errors = [];
    }

    public function addError(string $field, string $message): void
    {
        $this->errors[$field][] = $message;
    }

    public function hasErrors(): bool
    {
        return count($this->errors) > 0;
    }

    public function errors(): array
    {
        return $this->errors;
    }
}
