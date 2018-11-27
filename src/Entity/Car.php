<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     attributes={
            "order": {"brand": "ASC"}
 *     },
 *     itemOperations={
 *         "get",
 *         "patch": {"method": "PATCH"}
 *     },
 *     collectionOperations={
 *         "post",
 *         "get"
 *     }
 * )
 * @ApiFilter(SearchFilter::class, properties={"brand": "partial", "numberPlate": "exact"})
 * @ORM\Entity
 */
class Car
{
    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column
     * @Assert\NotNull
     * @Assert\Length(max="20")
     */
    private $brand;

    /**
     * @var string
     *
     * @ORM\Column
     * @Assert\NotNull
     * @Assert\Length(max="30")
     */
    private $model;

    /**
     * @var string
     *
     * @ORM\Column
     * @Assert\NotNull
     */
    private $numberPlate;

    public function getId(): int
    {
        return $this->id;
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function getNumberPlate(): string
    {
        return $this->numberPlate;
    }

    public function setNumberPlate(string $numberPlate): void
    {
        $this->numberPlate = $numberPlate;
    }
}
