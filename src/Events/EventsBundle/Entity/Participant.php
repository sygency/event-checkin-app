<?php

namespace Events\EventsBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Events\EventsBundle\Entity\Ticket;

/**
 * Participant
 *
 * @ORM\Table(name="participants")
 * @ORM\Entity(repositoryClass="Events\EventsBundle\Entity\ParticipantRepository")
 */
class Participant
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
     * @ORM\Column(name="full_name", type="string", length=255)
     */
    private $fullName;

    /**
     * @ORM\OneToMany(targetEntity="Ticket", mappedBy="participants")
     */
    protected $tickets;

    /**
     * Constructor
     */
    public function __construct() {
        $this->tickets = new ArrayCollection();
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
     * Set fullName
     *
     * @param string $fullName
     * @return Participant
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string 
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Add tickets
     *
     * @param Ticket $tickets
     * @return Participant
     */
    public function addTicket(Ticket $tickets)
    {
        $this->tickets[] = $tickets;

        return $this;
    }

    /**
     * Remove tickets
     *
     * @param Ticket $tickets
     */
    public function removeTicket(Ticket $tickets)
    {
        $this->tickets->removeElement($tickets);
    }

    /**
     * Get tickets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTickets()
    {
        return $this->tickets;
    }
}
