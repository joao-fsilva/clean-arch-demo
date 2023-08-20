<?php

namespace Tests\Unit\Domain\_Common;

use Demo\Domain\_Common\Notification\Notification;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    private Notification $notification;

    protected function setUp(): void
    {
        $this->notification = new Notification();
    }

    public function testShouldAddErrors(): void
    {
        $this->notification->addError(field: 'name', message: 'name is invalid.');
        $this->notification->addError(field: 'name', message: 'name is empty.');
        $this->notification->addError(field: 'email', message: 'email is invalid.');

        $errors = $this->notification->errors();

        $this->assertCount(2, $errors);
        $this->assertTrue($this->notification->hasErrors());

        $name = $errors['name'];
        $email = $errors['email'];

        $this->assertCount(2, $name);
        $this->assertCount(1, $email);

        $this->assertSame('name is invalid.', $name[0]);
        $this->assertSame('name is empty.', $name[1]);
        $this->assertSame('email is invalid.', $email[0]);
    }
}
