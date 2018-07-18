<?php

namespace HealthCheck;

use HealthCheck\Check\CheckInterface;
use HealthCheck\Check\CollectionRepositoryInterface;

final class Runner
{
    private $checks;

    public function __construct(CollectionRepositoryInterface $checks)
    {
        $this->checks = $checks;
    }

    public function runCheck(string $name): Result
    {
        if ($this->checks->has($name)) {
            return $this->checks->get($name)->check();
        }
    }

    public function runChecks(): iterable
    {
        /* @var $check CheckInterface */
        foreach ($this->checks->getAll() as $name => $check) {
            yield $name => $check->check();
        }
    }
}
