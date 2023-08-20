<?php

namespace Demo\Application\Customer\Create;

use Demo\Domain\Entity\Customer;
use Demo\Domain\Repository\CustomerRepository;

class CreateCustomer
{
    public function __construct(
        private CustomerRepository $customerRepository
    )
    {
    }

    public function execute(CreateCustomerInputDto $dto): CreateCustomerOutputDto
    {
        $customer = new Customer(name: $dto->name);

        $this->customerRepository->create(customer: $customer);

        return new CreateCustomerOutputDto();
    }
}
