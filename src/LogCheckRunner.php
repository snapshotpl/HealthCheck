<?php
/**
 * Created by PhpStorm.
 * User: witold
 * Date: 18.07.18
 * Time: 22:45
 */

namespace HealthCheck;


use HealthCheck\Check\CheckInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

final class LogCheckRunner implements CheckRunner
{
    private $log;
    private $checkRunner;

    public function __construct(CheckRunner $checkRunner, LoggerInterface $log)
    {
        $this->log = $log;
        $this->checkRunner = $checkRunner;
    }

    public function run(CheckInterface $check): Result
    {
        $result = $this->checkRunner->run($check);

        $this->log->log(LogLevel::INFO, 'Check report', ResultArraySerializer::toArray($result));

        return $result;
    }
}
