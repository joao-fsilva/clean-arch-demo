<?php

namespace Tests\Unit\Application\Customer;

use Demo\Application\Customer\FindAll\FindAllCustomer;
use Demo\Application\Customer\FindAll\FindAllCustomerInputDto;
use Demo\Domain\Repository\CustomerRepository;
use Tests\TestCase;

class FindAllCustomerTest extends TestCase
{
    private CustomerRepository $customerRepository;
    private FindAllCustomer $findAllCustomer;
    private FindAllCustomerInputDto $dto;

    protected function setUp(): void
    {
        $this->customerRepository = $this->createMock(CustomerRepository::class);

        $this->findAllCustomer = new FindAllCustomer(customerRepository: $this->customerRepository);

        $this->dto = new FindAllCustomerInputDto();
        $this->dto->limit = 1;
        $this->dto->offset = 1;
    }

    public function testShouldFindAllCustomers(): void
    {
        $customersData = [
            ['id' => 1, 'name' => 'João Silva'],
        ];

        $this->customerRepository
            ->expects($this->exactly(1))
            ->method('findAll')
            ->willReturn($customersData);

        $customers = $this->findAllCustomer->execute(dto: $this->dto)->customers;
        $customer = $customers[0];

        $this->assertCount(1, $customers);
        $this->assertCount(2, array_keys($customer));
        $this->assertSame($customersData[0]['id'], $customer['id']);
        $this->assertSame($customersData[0]['name'], $customer['name']);
    }
}
