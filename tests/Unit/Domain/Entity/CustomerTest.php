<?php

namespace Tests\Unit\Domain\Entity;

use Demo\Domain\_Common\Exception\EntityValidationException;
use Demo\Domain\Entity\Customer;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    public function testShouldThrowEntityValidationExceptionFieldNameBelowMinLength(): void
    {
        $this->expectException(EntityValidationException::class);

        new Customer(name: 'ab');
    }

    public function testShouldThrowEntityValidationExceptionFieldNameExceedsMaxLength(): void
    {
        $this->expectException(EntityValidationException::class);

        new Customer(name: str_repeat('a', 256));
    }

    public function testEntityOk(): void
    {
        $name = 'João Silva';

        $customer = new Customer(
            name: $name,
        );

        $this->assertSame($name, $customer->name());
    }
}
