<?php

namespace HealthCheck\Check;

use HealthCheck\Result;

final class TestCheck implements CheckInterface
{
    private $result;
    private $title;

    public function __construct(Result $result, string $title = 'Test Check')
    {
        $this->result = $result;
        $this->title = $title;
    }

    public function check(): Result
    {
        return $this->result;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}
