<?php

declare(strict_types=1);

namespace App\DataProvider;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Car;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class CarItemProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    private $carRepository;

    public function __construct(RegistryInterface $registry)
    {
        $this->carRepository = $registry->getRepository(Car::class);
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $resourceClass === Car::class;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        try {
            return \file_get_contents(\sprintf('../data/car_%d.xml', $id));
        } catch (\Exception $e) {
            return $this->carRepository->find($id);
        }
    }
}