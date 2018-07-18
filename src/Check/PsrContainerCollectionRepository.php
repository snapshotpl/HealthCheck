<?php

namespace HealthCheck\Check;

use Psr\Container\ContainerInterface;

final class PsrContainerCollectionRepository implements CollectionRepositoryInterface
{
    private $container;
    private $checkServiceNames;

    public function __construct(ContainerInterface $container, array $checkServiceNames)
    {
        $this->container = $container;
        $this->checkServiceNames = $checkServiceNames;
    }

    public function get(string $name): CheckInterface
    {
        if ($this->has($name)) {
            return $this->container->get($this->checkServiceNames[$name]);
        }
        throw new CheckNotFoundException();
    }

    public function getAll(): iterable
    {
        foreach ($this->checkServiceNames as $name => $serviceName) {
            yield $name => $this->container->get($serviceName);
        }
    }

    public function has(string $name): bool
    {
        return isset($this->checkServiceNames[$name]);
    }
}
