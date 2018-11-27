<?php

declare(strict_types=1);

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Car;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class CarPersister implements DataPersisterInterface
{
    private $registry;

    private $serializer;

    private $fileSystem;

    public function __construct(RegistryInterface $registry, SerializerInterface $serializer)
    {
        $this->registry = $registry;
        $this->serializer = $serializer;
        $this->fileSystem = new Filesystem();
    }

    public function supports($data): bool
    {
        return $data instanceof Car;
    }

    public function persist($data)
    {
        $em = $this->registry->getEntityManager();
        $em->persist($data);
        $em->flush();

        $this->fileSystem->dumpFile(\sprintf('../data/car_%d.xml', $data->getId()), $this->serializer->serialize($data, XmlEncoder::FORMAT));

        return $data;
    }

    public function remove($data)
    {
        throw \BadMethodCallException('You cannot delete a car.');
    }
}