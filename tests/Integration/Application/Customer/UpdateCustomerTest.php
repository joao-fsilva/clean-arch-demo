<?php

namespace Tests\Integration\Application\Customer;

use App\Repository\CustomerRepositoryEloquent;
use Demo\Application\Customer\Update\UpdateCustomer;
use Demo\Application\Customer\Update\UpdateCustomerInputDto;
use Demo\Domain\Repository\CustomerRepository;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;
use App\Models\Customer as CustomerModel;

class UpdateCustomerTest extends TestCase
{
    use DatabaseTransactions;

    private CustomerRepository $customerRepository;
    private UpdateCustomer $updateCustomer;
    private UpdateCustomerInputDto $dto;

    protected function setUp(): void
    {
        parent::setUp();

        $this->customerRepository = new CustomerRepositoryEloquent(new CustomerModel());

        $this->updateCustomer = new UpdateCustomer(customerRepository: $this->customerRepository);

        $this->dto = new UpdateCustomerInputDto();
    }

    public function testShouldUpdateCustomer(): void
    {
        $customerModel = CustomerModel::factory()->create();

        $this->dto->id = $customerModel->id;
        $this->dto->name = 'Test name';

        $this->updateCustomer->execute(dto: $this->dto);

        $customerModelUpdated = CustomerModel::find($customerModel->id);

        $this->assertSame('Test name', $customerModelUpdated->name);
    }
}
