<?php
/**
 * Created by PhpStorm.
 * User: witold
 * Date: 13.07.18
 * Time: 22:41
 */

namespace HealthCheck;


use HealthCheck\Check\CheckInterface;

class FailureCheck implements CheckInterface
{

    public function check(): Result
    {
        return Result::failure($this, 'Wake up!', [
            'some' => 'data',
        ]);
    }

    public function getTitle(): string
    {
        return 'Failure check';
    }
}