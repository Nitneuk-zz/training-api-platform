<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
class User
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
     * @Assert\Length(max="30")
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column
     * @Assert\NotNull
     * @Assert\Length(max="30")
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column
     * @Assert\NotNull
     * @Assert\Choice(choices={"male", "female", "unknown"})
     */
    private $gender;

    /**
     * @var Booking[]
     *
     * @ORM\OneToMany(targetEntity=Booking::class, mappedBy="user")
     * @ApiSubresource
     */
    private $bookings;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function hasBooking(Booking $booking): bool
    {
        return $this->bookings->contains($booking);
    }

    public function addBooking(Booking $booking)
    {
        if (!$this->hasBooking($booking)) {
            $booking->setUser($this);

            $this->bookings->add($booking);
        }
    }

    public function removeBooking(Booking $booking)
    {
        if ($this->hasBooking($booking)) {
            $booking->setUser(null);

            $this->bookings->removeElement($booking);
        }
    }

    public function setBookings(array $bookings): void
    {
        $this->bookings = $bookings;
    }
}
