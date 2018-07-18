<?php

namespace HealthCheck\Check;

final class RuntimeSaveCheckRepositoryDecorator implements CollectionRepositoryInterface
{
    private $repository;

    public function __construct(CollectionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function get(string $name): CheckInterface
    {
        $check = $this->repository->get($name);

        $this->decorate($check);
    }

    public function getAll(): iterable
    {
        foreach ($this->repository->getAll() as $name => $check) {
            yield $name => $this->decorate($check);
        }
    }

    public function has(string $name): bool
    {
        $this->repository->has($name);
    }

    private function decorate(CheckInterface $check): RuntimeSafeCheckDecorator
    {
        if ($check instanceof RuntimeSafeCheckDecorator) {
            return $check;
        }
        return new RuntimeSafeCheckDecorator($check);
    }

}
