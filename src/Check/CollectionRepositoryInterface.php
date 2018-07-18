<?php

namespace HealthCheck\Check;

interface CollectionRepositoryInterface
{
    public function has(string $name): bool;

    /**
     * @throws CheckNotFoundException
     */
    public function get(string $name): CheckInterface;

    public function getAll(): iterable;
}
