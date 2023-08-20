<?php

namespace App\Http\Controllers;

use Demo\Application\Customer\Create\CreateCustomer;
use Demo\Application\Customer\Create\CreateCustomerInputDto;
use Demo\Application\Customer\Delete\DeleteCustomer;
use Demo\Application\Customer\Delete\DeleteCustomerInputDto;
use Demo\Application\Customer\FindAll\FindAllCustomer;
use Demo\Application\Customer\FindAll\FindAllCustomerInputDto;
use Demo\Application\Customer\Update\UpdateCustomer;
use Demo\Application\Customer\Update\UpdateCustomerInputDto;
use Demo\Domain\_Common\Exception\EntityNotFoundException;
use Demo\Domain\_Common\Exception\EntityValidationException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    public function index(Request $request, FindAllCustomer $findAllCustomer)
    {
        $this->validate($request, [
            'limit' => 'required|int',
            'offset' => 'required|int'
        ]);

        $dto = new FindAllCustomerInputDto();
        $dto->limit = $request->input('limit');
        $dto->offset = $request->input('offset');

        $customers = $findAllCustomer->execute($dto)->customers;

        return response()->json($customers);
    }

    public function create(Request $request, CreateCustomer $createCustomer)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        $dto = new CreateCustomerInputDto();
        $dto->name = $request->input('name');

        try {
            $createCustomer->execute($dto);
            return response()->json()->setStatusCode(Response::HTTP_CREATED);
        } catch (EntityValidationException $e) {
            return response()->json($e->errors())->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
    }

    public function update(Request $request, UpdateCustomer $updateCustomer, int $id)
    {
        $this->validate($request, [
            'name' => 'required|string',
        ]);

        $dto = new UpdateCustomerInputDto();
        $dto->id = $id;
        $dto->name = $request->input('name');

        try {
            $updateCustomer->execute($dto);
            return response()->json();
        } catch (EntityNotFoundException $e) {
            return response()->json($e->getMessage())->setStatusCode(Response::HTTP_NOT_FOUND);
        } catch (EntityValidationException $e) {
            return response()->json($e->errors())->setStatusCode(Response::HTTP_BAD_REQUEST);
        }
    }

    public function delete(Request $request, DeleteCustomer $deleteCustomer, int $id)
    {
        $dto = new DeleteCustomerInputDto();
        $dto->id = $id;

        try {
            $deleteCustomer->execute($dto);
            return response()->json()->setStatusCode(Response::HTTP_NO_CONTENT);
        } catch (EntityNotFoundException $e) {
            return response()->json($e->getMessage())->setStatusCode(Response::HTTP_NOT_FOUND);
        }
    }
}
