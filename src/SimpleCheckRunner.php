<?php
/**
 * Created by PhpStorm.
 * User: witold
 * Date: 18.07.18
 * Time: 22:39
 */

namespace HealthCheck;

use HealthCheck\Check\CheckInterface;

final class SimpleCheckRunner implements CheckRunner
{
    public function run(CheckInterface $check): Result
    {
        return $check->check();
    }
}
