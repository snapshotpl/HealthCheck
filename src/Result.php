<?php

namespace HealthCheck;

use HealthCheck\Check\CheckInterface;

final class Result
{
    const FAILURE = 'failure';
    const SKIP = 'skip';
    const SUCCESS = 'success';
    const WARNING = 'warning';

    private $result;
    private $message;
    private $data;
    private $check;

    public static function failure(CheckInterface $check, string $message, array $data = []): self
    {
        return new self($check, self::FAILURE, $message, $data);
    }

    public static function skip(CheckInterface $check, string $message, array $data = []): self
    {
        return new self($check, self::SKIP, $message, $data);
    }

    public static function success(CheckInterface $check, string $message, array $data = []): self
    {
        return new self($check, self::SUCCESS, $message, $data);
    }

    public static function warning(CheckInterface $check, string $message, array $data = []): self
    {
        return new self($check, self::WARNING, $message, $data);
    }

    private function __construct(CheckInterface $check, string $result, string $message, array $data)
    {
        $this->check = $check;
        $this->result = $result;
        $this->message = $message;
        $this->data = $data;
    }

    public function getCheck(): CheckInterface
    {
        return $this->check;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function isFailure(): bool
    {
        return $this->is(self::FAILURE);
    }

    public function isSkip(): bool
    {
        return $this->is(self::SKIP);
    }

    public function isSuccess(): bool
    {
        return $this->is(self::SUCCESS);
    }

    public function isWarning(): bool
    {
        return $this->is(self::WARNING);
    }

    private function is(string $result): bool
    {
        return $this->result === $result;
    }
}
