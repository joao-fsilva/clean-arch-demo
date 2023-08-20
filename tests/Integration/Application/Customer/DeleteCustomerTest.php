<?php

namespace Tests\Integration\Application\Customer;

use App\Repository\CustomerRepositoryEloquent;
use Demo\Application\Customer\Delete\DeleteCustomer;
use Demo\Application\Customer\Delete\DeleteCustomerInputDto;
use Demo\Domain\Repository\CustomerRepository;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Customer as CustomerModel;

class DeleteCustomerTest extends TestCase
{
    use DatabaseTransactions;

    private CustomerRepository $customerRepository;
    private DeleteCustomer $deleteCustomer;
    private DeleteCustomerInputDto $dto;

    protected function setUp(): void
    {
        parent::setUp();

        $this->customerRepository = new CustomerRepositoryEloquent(new CustomerModel());

        $this->deleteCustomer = new DeleteCustomer(customerRepository: $this->customerRepository);

        $this->dto = new DeleteCustomerInputDto();
    }

    public function testShouldDeleteCustomer(): void
    {
        $customerModel = CustomerModel::factory()->create();

        $this->dto->id = $customerModel->id;

        $this->deleteCustomer->execute(dto: $this->dto);

        $this->notSeeInDatabase('customers', ['name' => 'João Silva']);
    }
}
