<?php

namespace Presentation\Http\Controllers;

use Application\Services\ClientService;
use Domain\Client\DTO\ClientDTO;
use Support\Response\HttpStatusCode;

class ClientController extends Controller
{
    public function __construct(
        public ClientService $service = new ClientService
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
        $dto = ClientDTO::fromArray([
            "NOME" => input()->post("NOME"),
            "CIDADE_NOME" => input()->post("CIDADE_NOME"),
        ]);

        return responseJson($this->service->create($dto->toArray()), HttpStatusCode::HTTP_CREATED);
    }

    public function update(int $id): mixed
    {
        $dto = ClientDTO::fromArray([
            "NOME" => input()->find("NOME")->getValue(),
            "CIDADE_NOME" => input()->find("CIDADE_NOME")->getValue(),
        ]);
        return responseJson($this->service->update($id, $dto->toArray()), HttpStatusCode::HTTP_OK);
    }

    public function delete(int $id): mixed
    {
        return responseJson($this->service->delete($id), HttpStatusCode::HTTP_NO_CONTENT);
    }
}
