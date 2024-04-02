<?php

namespace Presentation\Http\Controllers;

use Application\Services\ProductService;
use Domain\Product\DTO\ProductDTO;
use Support\Response\HttpStatusCode;

class ProductController extends Controller {
    public function __construct(
        public ProductService $service = new ProductService
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
        $dto = ProductDTO::fromArray([
            "NOME" => input()->post("NOME")->value,
            "VLRUNIT" => input()->post("VLRUNIT")->value,
        ]);

        return responseJson($this->service->create($dto->toArray()), HttpStatusCode::HTTP_CREATED);
    }

    public function update(int $id): mixed
    {
        $dto = ProductDTO::fromArray([
            "NOME" => input()->find("NOME")->getValue(),
            "VLRUNIT" => input()->find("VLRUNIT")->getValue(),
        ]);
        return responseJson($this->service->update($id, $dto->toArray()), HttpStatusCode::HTTP_OK);
    }

    public function delete(int $id): mixed
    {
        return responseJson($this->service->delete($id), HttpStatusCode::HTTP_NO_CONTENT);
    }
}