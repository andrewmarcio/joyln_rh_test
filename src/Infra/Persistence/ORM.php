<?php

declare(strict_types=1);

namespace Infra\Persistence;

use PDO;
use PDOStatement;
use Support\Traits\ValidateEntityProperties;

abstract class ORM extends DatabaseConnection
{
    use ValidateEntityProperties;

    protected string $table;

    private DatabaseConnection $connection;
    private PDOStatement $statement;

    /**
     * @var array<string, mixed> $query
     */
    private array $query = [];


    public function __construct()
    {
        $this->connection = new DatabaseConnection;
    }

    public function checkQueryIsEmpty(): void
    {
        if (empty($this->query)) {
            $this->select();
        }
    }

    private function getTable(): string
    {
        return $this->table;
    }

    public function select(array $columns = ["*"]): self
    {
        $columns = implode(",", array_filter($columns));
        $this->query = [
            "SELECT",
            $columns,
            "FROM",
            $this->getTable(),
        ];

        return $this;
    }

    public function where(string $column, string $condition, mixed $value): self
    {
        $this->checkQueryIsEmpty();

        if (!in_array("WHERE", $this->query)) {
            $this->query = array_merge($this->query, ["WHERE"]);
        } else {
            $this->query = array_merge($this->query, ["AND"]);
        }

        $this->query = array_merge($this->query, [
            $column,
            $condition,
            str_pad((string) $value, (strlen((string) $value) + 2), "'", STR_PAD_BOTH),
        ]);

        return $this;
    }

    public function latest(string $column = "created_at"): self
    {
        $this->checkQueryIsEmpty();

        $this->query = array_merge($this->query, [
            "ORDER BY",
            $column,
            "DESC"
        ]);

        return $this;
    }

    public function first(): self
    {
        $this->checkQueryIsEmpty();
        $this->query = array_merge($this->query, ["LIMIT", 1]);

        $this->executeQuery();

        if (!$data = $this->statement->fetchObject(get_class($this)))
            throw new \Exception("Entity is not found");

        return $data;
    }

    public function get(): array
    {
        $this->checkQueryIsEmpty();

        $this->executeQuery();

        if (!$data = $this->statement->fetchAll(PDO::FETCH_CLASS, get_class($this)))
            return [];

        return $data;
    }

    public function create(array $data = []): self
    {
        $data = $this->validateProperties($data);

        $this->query = [
            "INSERT INTO",
            $this->getTable(),
            "(",
            implode(",", array_filter(array_keys($data))),
            ")",
            "VALUES",
            "(",
            implode(",", str_split(str_pad("", count($data), "?"))),
            ")",
        ];

        $this->executeQuery(array_values($data));

        return (new static)->latest()->first();
    }

    public function update(int $id, array $data = []): self
    {
        $data = $this->validateProperties($data);

        $this->query = [
            "UPDATE",
            $this->getTable(),
            "SET",
            implode(", ", array_merge(
                array_map(function ($property) {
                    return str_pad($property, (strlen($property) + 4), " = ?");
                }, array_keys($data)),
                ['updated_at = ?']
            )),
            "WHERE",
            "id",
            "=",
            "?"
        ];

        $this->executeQuery(array_merge(
            array_values($data),
            [date_format(new \DateTime(), 'Y-m-d H:i:s')],
            [$id]
        ));
        unset($this->statement);

        return (new static)->where("id", "=", $id)->first();
    }

    public function delete(int $id): bool
    {
        try {
            $this->query = [
                "DELETE FROM",
                $this->getTable(),
                "WHERE",
                "id",
                "=",
                "?",
            ];

            $this->executeQuery([$id]);
            unset($this->statement);

            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    private function executeQuery(?array $params = null): void
    {
        $this->statement = $this->connection
            ->getConnection()
            ->prepare(implode(" ", $this->query));

        unset($this->query);
        $this->statement->execute($params);
    }
}
