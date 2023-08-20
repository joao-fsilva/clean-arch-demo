<?php

namespace Demo\Application\Customer\Update;

use Demo\Domain\Repository\CustomerRepository;

class UpdateCustomer
{
    public function __construct(
        private CustomerRepository $customerRepository
    )
    {
    }

    public function execute(UpdateCustomerInputDto $dto): UpdateCustomerOutputDto
    {
        $customer = $this->customerRepository->findById(id: $dto->id);

        $customer->changeName(name: $dto->name);

        $customer->throwExceptionIfHasErrors();

        $this->customerRepository->update(customer: $customer);

        return new UpdateCustomerOutputDto();
    }
}
