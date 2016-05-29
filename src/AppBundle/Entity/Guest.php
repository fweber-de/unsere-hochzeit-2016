<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Guest
 *
 * @ORM\Table(name="guest")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GuestRepository")
 */
class Guest
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_going", type="boolean")
     */
    private $isGoing;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_child_guest", type="boolean")
     */
    private $isChildGuest;

    /**
     * @ORM\ManyToOne(targetEntity="GuestCollective", inversedBy="guests")
     * @ORM\JoinColumn(name="collective_id", referencedColumnName="id")
     */
    private $collective;

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
     * Set name
     *
     * @param string $name
     *
     * @return Guest
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set isGoing
     *
     * @param boolean $isGoing
     *
     * @return Guest
     */
    public function setIsGoing($isGoing)
    {
        $this->isGoing = $isGoing;

        return $this;
    }

    /**
     * Get isGoing
     *
     * @return boolean
     */
    public function getIsGoing()
    {
        return $this->isGoing;
    }

    /**
     * Set collective
     *
     * @param \AppBundle\Entity\GuestCollective $collective
     *
     * @return Guest
     */
    public function setCollective(\AppBundle\Entity\GuestCollective $collective = null)
    {
        $this->collective = $collective;

        return $this;
    }

    /**
     * Get collective
     *
     * @return \AppBundle\Entity\GuestCollective
     */
    public function getCollective()
    {
        return $this->collective;
    }

    /**
     * Set isChildGuest
     *
     * @param boolean $isChildGuest
     *
     * @return Guest
     */
    public function setIsChildGuest($isChildGuest)
    {
        $this->isChildGuest = $isChildGuest;

        return $this;
    }

    /**
     * Get isChildGuest
     *
     * @return boolean
     */
    public function getIsChildGuest()
    {
        return $this->isChildGuest;
    }
}
