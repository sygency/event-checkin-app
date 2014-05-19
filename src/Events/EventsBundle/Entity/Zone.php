<?php

namespace Events\EventsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Zone
 *
 * @ORM\Table(name="zones")
 * @ORM\Entity(repositoryClass="Events\EventsBundle\Entity\ZoneRepository")
 */
class Zone
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="Seat", mappedBy="zones")
     */
    protected $seats;

    /**
     * Constructor
     */
    public function __construct() {
        $this->seats = new ArrayCollection();
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
     * @return Zone
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
     * Set name
     *
     * @param string $name
     * @return Zone
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
     * Add seats
     *
     * @param \Events\EventsBundle\Entity\Seat $seats
     * @return Zone
     */
    public function addSeat(\Events\EventsBundle\Entity\Seat $seats)
    {
        $this->seats[] = $seats;

        return $this;
    }

    /**
     * Remove seats
     *
     * @param \Events\EventsBundle\Entity\Seat $seats
     */
    public function removeSeat(\Events\EventsBundle\Entity\Seat $seats)
    {
        $this->seats->removeElement($seats);
    }

    /**
     * Get seats
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSeats()
    {
        return $this->seats;
    }
}
