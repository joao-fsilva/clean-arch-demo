<?php

namespace Demo\Application\Customer\Delete;

use Demo\Domain\Repository\CustomerRepository;

class DeleteCustomer
{
    public function __construct(
        private CustomerRepository $customerRepository
    )
    {
    }

    public function execute(DeleteCustomerInputDto $dto): DeleteCustomerOutputDto
    {
        $customer = $this->customerRepository->findById(id: $dto->id);

        $this->customerRepository->delete(id: $customer->id());

        return new DeleteCustomerOutputDto();
    }
}
