<?php

namespace HealthCheck;

use HealthCheck\Check\CheckInterface;
use HealthCheck\Check\CollectionRepositoryInterface;

final class Runner implements CheckRunner
{
    private $checks;

    public function __construct(CollectionRepositoryInterface $checks)
    {
        $this->checks = $checks;
    }

    public function runCheck(string $name): Result
    {
        if ($this->checks->has($name)) {
            return $this->run($this->checks->get($name));
        }
    }

    public function runChecks(): iterable
    {
        /* @var $check CheckInterface */
        foreach ($this->checks->getAll() as $name => $check) {
            yield $name => $this->run($check);
        }
    }

    public function run(CheckInterface $check): Result
    {
        return $check->check();
    }
}
