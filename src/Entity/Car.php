<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     normalizationContext={"groups": {"car_read"}},
 *     denormalizationContext={"groups": {"car_write"}},
 *     paginationItemsPerPage=10,
 *     attributes={
 *          "order": {"brand": "ASC"}
 *     },
 *     itemOperations={
 *         "get": {"access_control": "is_granted('ROLE_ADMIN')"},
 *         "patch": {"method": "PATCH", "validationGroups"="patch_validation"}
 *     },
 *     collectionOperations={
 *         "post": {"validationGroups"="post_validation"},
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
     * @Assert\Length(max="20", groups={"patch_validation"})
     * @Assert\Length(max="30", groups={"post_validation"})
     * @Groups({
     *     "car_read",
     *     "car_write"
     * })
     */
    private $brand;

    /**
     * @var string
     *
     * @ORM\Column
     * @Assert\NotNull
     * @Assert\Length(max="30")
     * @Groups({
     *     "car_read",
     *     "car_write"
     * })
     */
    private $model;

    /**
     * @var string
     *
     * @ORM\Column
     * @Assert\NotNull
     * @Groups({
     *     "car_write"
     * })
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
