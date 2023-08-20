<?php

namespace App\Repository;

use Demo\Domain\_Common\Exception\EntityNotFoundException;
use Demo\Domain\Entity\Customer;
use Demo\Domain\Repository\CustomerRepository;
use App\Models\Customer as CustomerModel;

class CustomerRepositoryEloquent implements CustomerRepository
{
    public function __construct(private CustomerModel $customerModel)
    {
    }

    public function create(Customer $customer): void
    {
        $newCustomer = $this->customerModel->create([
           'name' => $customer->name()
        ]);

        $customer->changeId(id: $newCustomer->id);
    }

    public function findById(int $id): Customer
    {
        $customerModel = $this->customerModel->find($id);
        if (empty($customerModel)) {
            throw new EntityNotFoundException('Customer');
        }

        $customer = new Customer($customerModel->name);
        $customer->changeId(id: $customerModel->id);
        $customer->changeCreatedAt(createdAt: $customerModel->created_at);
        $customer->changeUpdatedAt(updatedAt: $customerModel->updated_at);

        return $customer;
    }

    public function update(Customer $customer): void
    {
        $customerModel = $this->customerModel->find($customer->id());

        $customerModel->update([
            'name' => $customer->name()
        ]);
    }

    public function delete(int $id): void
    {
        $customerModel = $this->customerModel->find($id);
        $customerModel->delete();
    }

    public function findAll(int $limit, int $offset): array
    {
        return CustomerModel::select('id', 'name', 'created_at', 'updated_at')
            ->limit($limit)
            ->offset($offset)
            ->orderBy('name')
            ->get()
            ->toArray();
    }
}
