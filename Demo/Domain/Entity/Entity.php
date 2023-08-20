<?php

namespace Demo\Domain\Entity;

use DateTime;
use DateTimeImmutable;
use Demo\Domain\_Common\Exception\EntityValidationException;
use Demo\Domain\_Common\Notification\Notification;

abstract class Entity
{
    protected ?int $id;
    protected DateTime $createdAt;
    protected DateTime $updatedAt;
    protected Notification $notification;

    public function __construct()
    {
        $this->id = null;
        $this->notification = new Notification();
    }

    public function changeId(int $id): void
    {
        $this->id = $id;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function changeCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function createdAt(): DateTime
    {
        return $this->createdAt;
    }

    public function changeUpdatedAt(DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function updatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function throwExceptionIfHasErrors(): void
    {
        if ($this->notification->hasErrors()) {
            throw new EntityValidationException($this->notification->errors());
        }
    }
}
