<?php

namespace Tests\Unit\Application\Customer;

use Demo\Application\Customer\Create\CreateCustomer;
use Demo\Application\Customer\Create\CreateCustomerInputDto;
use Demo\Domain\Repository\CustomerRepository;
use Tests\TestCase;

class CreateCustomerTest extends TestCase
{
    private CustomerRepository $customerRepository;
    private CreateCustomer $createCustomer;
    private CreateCustomerInputDto $dto;

    protected function setUp(): void
    {
        $this->customerRepository = $this->createMock(CustomerRepository::class);

        $this->createCustomer = new CreateCustomer(customerRepository: $this->customerRepository);

        $this->dto = new CreateCustomerInputDto();
        $this->dto->name = 'João Silva';
    }

    public function testShouldCreateCustomer(): void
    {
        $this->customerRepository
            ->expects($this->exactly(1))
            ->method('create');

        $this->createCustomer->execute(dto: $this->dto);
    }
}
