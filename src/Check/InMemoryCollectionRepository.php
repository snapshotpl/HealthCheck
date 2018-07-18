<?php

namespace HealthCheck\Check;

final class InMemoryCollectionRepository implements CollectionRepositoryInterface
{
    private $checks;

    public function __construct(array $checks)
    {
        $this->checks = $checks;
    }

    public function get(string $name): CheckInterface
    {
        if ($this->has($name)) {
            return $this->checks[$name];
        }
        throw new CheckNotFoundException();
    }

    public function getAll(): iterable
    {
        return $this->checks;
    }

    public function has(string $name): bool
    {
        return isset($this->checks[$name]);
    }
}
