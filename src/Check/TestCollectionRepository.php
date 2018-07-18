<?php

namespace HealthCheck\Check;

final class TestCollectionRepository implements CollectionRepositoryInterface
{
    private $checks = [];

    public static function createEmpty(): self
    {
        return new self([]);
    }

    public static function createOneCheck(CheckInterface $check, string $name): self
    {
        return new self([
            $name => $check,
        ]);
    }

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
