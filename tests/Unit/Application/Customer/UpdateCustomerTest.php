<?php

namespace Tests\Unit\Application\Customer;

use Demo\Application\Customer\Update\UpdateCustomer;
use Demo\Application\Customer\Update\UpdateCustomerInputDto;
use Demo\Domain\Repository\CustomerRepository;
use Tests\TestCase;

class UpdateCustomerTest extends TestCase
{
    private CustomerRepository $customerRepository;
    private UpdateCustomer $updateCustomer;
    private UpdateCustomerInputDto $dto;

    protected function setUp(): void
    {
        $this->customerRepository = $this->createMock(CustomerRepository::class);

        $this->updateCustomer = new UpdateCustomer(customerRepository: $this->customerRepository);

        $this->dto = new UpdateCustomerInputDto();
        $this->dto->id = 1;
        $this->dto->name = 'João Silva';
    }

    public function testShouldUpdateCustomer(): void
    {
        $this->customerRepository
            ->expects($this->exactly(1))
            ->method('update');

        $this->updateCustomer->execute(dto: $this->dto);
    }
}
