<?php

namespace Demo\Domain\Repository;

use Demo\Domain\Entity\Customer;

interface CustomerRepository
{
    public function create(Customer $customer): void;
    public function findById(int $id): Customer;
    public function update(Customer $customer): void;
    public function delete(int $id): void;
    public function findAll(int $limit, int $offset): array;
}
