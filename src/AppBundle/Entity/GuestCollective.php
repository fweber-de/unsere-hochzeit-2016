<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * GuestCollective
 *
 * @ORM\Table(name="guest_collective")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GuestCollectiveRepository")
 */
class GuestCollective
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255, unique=true)
     */
    private $code;

    /**
     * @ORM\OneToMany(targetEntity="Guest", mappedBy="collective", cascade="remove")
     */
    private $guests;

    public function __construct()
    {
        $this->guests = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return GuestCollective
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return GuestCollective
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Add guest
     *
     * @param \AppBundle\Entity\Guest $guest
     *
     * @return GuestCollective
     */
    public function addGuest(\AppBundle\Entity\Guest $guest)
    {
        $this->guests[] = $guest;

        return $this;
    }

    /**
     * Remove guest
     *
     * @param \AppBundle\Entity\Guest $guest
     */
    public function removeGuest(\AppBundle\Entity\Guest $guest)
    {
        $this->guests->removeElement($guest);
    }

    /**
     * Get guests
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGuests()
    {
        return $this->guests;
    }
}
