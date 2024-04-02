<?php

namespace Presentation\Http\Controllers;

use Application\Services\OrderService;
use Domain\Order\DTO\OrderDTO;
use Support\Response\HttpStatusCode;

class OrderController extends Controller {
    public function __construct(
        public OrderService $service = new OrderService
    ) {
    }

    public function index(): mixed
    {
        return responseJson($this->service->index(), HttpStatusCode::HTTP_OK);
    }

    public function show(int $id): mixed
    {
        return responseJson($this->service->find($id), HttpStatusCode::HTTP_OK);
    }

    public function store(): mixed
    {
        $dto = OrderDTO::fromArray([
            "client_id" => input()->post("CLIENT_ID")->value,
            "items" => input()->all(["ITEMS"])["ITEMS"],
        ]);

        return responseJson($this->service->create($dto->toArray()), HttpStatusCode::HTTP_CREATED);
    }

    public function update(int $id): mixed
    {
        $dto = OrderDTO::fromArray([
            "client_id" => input()->find("CLIENT_ID")->getValue(),
            "items" => input()->all(["ITEMS"])["ITEMS"],
        ]);
        return responseJson($this->service->update($id, $dto->toArray()), HttpStatusCode::HTTP_OK);
    }

    public function delete(int $id): mixed
    {
        return responseJson($this->service->delete($id), HttpStatusCode::HTTP_NO_CONTENT);
    }
}