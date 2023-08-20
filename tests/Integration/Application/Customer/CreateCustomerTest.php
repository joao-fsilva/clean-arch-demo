<?php

namespace Tests\Integration\Application\Customer;

use App\Repository\CustomerRepositoryEloquent;
use Demo\Application\Customer\Create\CreateCustomer;
use Demo\Application\Customer\Create\CreateCustomerInputDto;
use Demo\Domain\Repository\CustomerRepository;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Customer as CustomerModel;

class CreateCustomerTest extends TestCase
{
    use DatabaseTransactions;

    private CustomerRepository $customerRepository;
    private CreateCustomer $createCustomer;
    private CreateCustomerInputDto $dto;

    protected function setUp(): void
    {
        parent::setUp();

        $this->customerRepository = new CustomerRepositoryEloquent(new CustomerModel());

        $this->createCustomer = new CreateCustomer(customerRepository: $this->customerRepository);

        $this->dto = new CreateCustomerInputDto();
        $this->dto->name = 'João Silva';
    }

    public function testShouldCreateCustomer(): void
    {
        $this->createCustomer->execute(dto: $this->dto);

        $this->seeInDatabase('customers', ['name' => 'João Silva']);
    }
}
