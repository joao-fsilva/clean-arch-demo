<?php

namespace Tests\Integration\Application\Customer;

use App\Repository\CustomerRepositoryEloquent;
use Demo\Application\Customer\FindAll\FindAllCustomer;
use Demo\Application\Customer\FindAll\FindAllCustomerInputDto;
use Demo\Domain\Repository\CustomerRepository;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Customer as CustomerModel;

class FindAllCustomerTest extends TestCase
{
    use DatabaseTransactions;

    private CustomerRepository $customerRepository;
    private FindAllCustomer $findAllCustomer;
    private FindAllCustomerInputDto $dto;

    protected function setUp(): void
    {
        parent::setUp();

        $this->customerRepository = new CustomerRepositoryEloquent(new CustomerModel());

        $this->findAllCustomer = new FindAllCustomer(customerRepository: $this->customerRepository);

        $this->dto = new FindAllCustomerInputDto();
    }

    public function testShouldFindAllCustomers(): void
    {
        $customerModel = CustomerModel::factory()->create();

        $this->dto->limit = 1;
        $this->dto->offset = 0;

        $customers = $this->findAllCustomer->execute(dto: $this->dto)->customers;
        $customer = $customers[0];

        $this->assertCount(1, $customers);
        $this->assertCount(4, array_keys($customer));
        $this->assertSame($customerModel->id, $customer['id']);
        $this->assertSame($customerModel->name, $customer['name']);
        $this->assertNotEmpty($customer['created_at']);
        $this->assertNotEmpty($customer['updated_at']);
    }
}
