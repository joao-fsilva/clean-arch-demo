<?php

namespace Tests\Unit\Application\Customer;

use Demo\Application\Customer\Delete\DeleteCustomer;
use Demo\Application\Customer\Delete\DeleteCustomerInputDto;
use Demo\Domain\Entity\Customer;
use Demo\Domain\Repository\CustomerRepository;
use Tests\TestCase;

class DeleteCustomerTest extends TestCase
{
    private CustomerRepository $customerRepository;
    private DeleteCustomer $deleteCustomer;
    private DeleteCustomerInputDto $dto;

    protected function setUp(): void
    {
        $this->customerRepository = $this->createMock(CustomerRepository::class);

        $this->deleteCustomer = new DeleteCustomer(customerRepository: $this->customerRepository);

        $this->dto = new DeleteCustomerInputDto();
        $this->dto->id = 1;
    }

    public function testShouldDeleteCustomer(): void
    {
        $customer = new Customer('name');
        $customer->changeId(id: 1);

        $this->customerRepository
            ->expects($this->exactly(1))
            ->method('findById')
            ->willReturn($customer);

        $this->customerRepository
            ->expects($this->exactly(1))
            ->method('delete');

        $this->deleteCustomer->execute(dto: $this->dto);
    }
}
