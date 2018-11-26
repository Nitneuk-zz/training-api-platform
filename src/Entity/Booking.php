<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     itemOperations={
 *         "get",
 *         "patch": {"method": "PATCH"}
 *     },
 *     collectionOperations={
 *         "post",
 *         "get"
 *     }
 * )
 * @ORM\Entity
 */
class Booking
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
     * @var User
     *
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="bookings")
     */
    private $user;

    /**
     * @var Car
     *
     * @ORM\ManyToOne(targetEntity=Car::class)
     */
    private $car;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @Assert\DateTime
     */
    private $fromDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     * @Assert\DateTime
     */
    private $toDate;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function getCar(): Car
    {
        return $this->car;
    }

    public function setCar(Car $car): void
    {
        $this->car = $car;
    }

    public function getFromDate(): \DateTime
    {
        return $this->fromDate;
    }

    public function setFromDate(\DateTime $fromDate): void
    {
        $this->fromDate = $fromDate;
    }

    public function getToDate(): \DateTime
    {
        return $this->toDate;
    }

    public function setToDate(\DateTime $toDate): void
    {
        $this->toDate = $toDate;
    }
}
