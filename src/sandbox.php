<?php

require __DIR__ . '/../vendor/autoload.php';

$checks = [
    new \HealthCheck\SleepCheck(),
    new \HealthCheck\SleepCheck(),
    new \HealthCheck\FailureCheck(),
];

$repository = new \HealthCheck\Check\InMemoryCollectionRepository($checks);

$runner = new \HealthCheck\Runner($repository);

final class intserializer implements JsonSerializable {
    private $value = 0;

    public function increment(): void
    {
        $this->value++;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function jsonSerialize()
    {
        return $this->value;
    }
}

final class notappearResultserializer implements JsonSerializable {
    private $value;

    public function __construct(intserializer $value)
    {
        $this->value = $value;
    }

    public function appear(): bool
    {
        return $this->value->value() > 0;
    }

    public function jsonSerialize()
    {
        return !$this->appear();
    }
}

$encoder = (new \Violet\StreamingJsonEncoder\BufferJsonEncoder(function () use ($runner){
    $success = new intserializer();
    $failure = new intserializer();
    $passed = new notappearResultserializer($failure);
    $f = function () use ($runner, $success, $failure) {
        foreach ($runner->runChecks() as $name => $result) {
            yield $result->getCheck()->getTitle() => [
                'message' => $result->getMessage(),
                'data' => $result->getData(),
            ];
            if ($result->isSuccess()) {
                $success->increment();
            }
            if ($result->isFailure()) {
                $failure->increment();
            }
        }
    };
    yield 'details' => $f();
    yield 'success' => $success;
    yield 'failure' => $failure;
    yield 'passed' => $passed;
}));


$stream = new \Violet\StreamingJsonEncoder\JsonStream($encoder);

$response = new \Zend\Diactoros\Response($stream);

$body = $stream;
if ($body->isSeekable()) {
    $body->rewind();
}
while (! $body->eof()) {
    echo $body->read(10);
}

//echo Zend\Diactoros\Response\Serializer::toString($response);
