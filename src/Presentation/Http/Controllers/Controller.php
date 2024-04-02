<?php

namespace Presentation\Http\Controllers;

use Pecee\Http\Request;

abstract class Controller {
    public abstract function index(): mixed;
    // public abstract function show(int $id): mixed;
    // public abstract function create(Request $request): mixed;
    // public abstract function update(int $id, Request $request): mixed;
    // public abstract function delete(int $id): void;
}