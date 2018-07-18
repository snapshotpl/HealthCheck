<?php

namespace HealthCheck\Check;

use HealthCheck\Result;
use Throwable;

final class RuntimeSafeCheckDecorator implements CheckInterface
{
    private $check;

    public function __construct(CheckInterface $check)
    {
        $this->check = $check;
    }

    public function check(): Result
    {
        try {
            return $this->check->check();
        } catch (Throwable $exception) {
            return Result::failure($this->check, 'Uncatch exception from check', [
                'exception' => (string) $exception,
                'check_class' => get_class($this->check),
                'title' => $this->check->getTitle(),
            ]);
        }
    }

    public function getTitle(): string
    {
        try {
            return $this->check->getTitle();
        } catch (Throwable $exception) {
            return 'Cannot provide title of check';
        }
    }
}
