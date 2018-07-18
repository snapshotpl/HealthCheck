<?php declare(strict_types = 1);

namespace HealthCheck\Check;

use HealthCheck\Result;

interface CheckInterface
{
    public function check(): Result;

    public function getTitle(): string;
}
