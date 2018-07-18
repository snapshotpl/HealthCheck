<?php
/**
 * Created by PhpStorm.
 * User: witold
 * Date: 18.07.18
 * Time: 22:27
 */

namespace HealthCheck;

use HealthCheck\Check\CheckInterface;

interface CheckRunner
{
    public function run(CheckInterface $check): Result;
}
