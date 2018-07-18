<?php
/**
 * Created by PhpStorm.
 * User: witold
 * Date: 13.07.18
 * Time: 22:41
 */

namespace HealthCheck;


use HealthCheck\Check\CheckInterface;

final class SleepCheck implements CheckInterface
{
    private $sleep;

    public function __construct(int $sleep = 1)
    {
        $this->sleep = 1;
    }

    public function check(): Result
    {
        sleep($this->sleep);

        return Result::success($this, 'Wake up!', [
            'sleep_time' => 1,
        ]);
    }

    public function getTitle(): string
    {
        return 'sleep';
    }
}
