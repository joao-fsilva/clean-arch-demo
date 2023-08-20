<?php

namespace Demo\Application\Customer\FindAll;

use Demo\Domain\Repository\CustomerRepository;

class FindAllCustomer
{
    public function __construct(
        private CustomerRepository $customerRepository
    )
    {
    }

    public function execute(FindAllCustomerInputDto $dto): FindAllCustomerOutputDto
    {
        $customers = $this->customerRepository->findAll(limit: $dto->limit, offset: $dto->offset);

        $dto = new FindAllCustomerOutputDto();
        $dto->customers = $customers;

        return $dto;
    }
}
