<?php

namespace Events\EventsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Events\EventsBundle\Entity\Participant;

/**
 * Ticket
 *
 * @ORM\Table(name="tickets")
 * @ORM\Entity(repositoryClass="Events\EventsBundle\Entity\TicketRepository")
 */
class Ticket
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
     * @var boolean
     *
     * @ORM\Column(name="checked_in", type="boolean")
     */
    private $checkedIn;

    /**
     * @ORM\ManyToOne(targetEntity="Seat", inversedBy="tickets")
     * @ORM\JoinColumn(name="seat_id", referencedColumnName="id")
     */
    protected $seat;

    /**
     * @ORM\ManyToOne(targetEntity="Participant", inversedBy="tickets")
     * @ORM\JoinColumn(name="participant_id", referencedColumnName="id")
     */
    protected $participant;

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
     * Set seat
     *
     * @param \Events\EventsBundle\Entity\Seat $seat
     * @return Ticket
     */
    public function setSeat(\Events\EventsBundle\Entity\Seat $seat = null)
    {
        $this->seat = $seat;

        return $this;
    }

    /**
     * Get seat
     *
     * @return \Events\EventsBundle\Entity\Seat 
     */
    public function getSeat()
    {
        return $this->seat;
    }

    /**
     * Set participant
     *
     * @param Participant $participant
     * @return Ticket
     */
    public function setParticipant(Participant $participant = null)
    {
        $this->participant = $participant;

        return $this;
    }

    /**
     * Get participant
     *
     * @return Participant
     */
    public function getParticipant()
    {
        return $this->participant;
    }

    /**
     * Set checkedIn
     *
     * @param boolean $checkedIn
     * @return Ticket
     */
    public function setCheckedIn($checkedIn)
    {
        $this->checkedIn = $checkedIn;

        return $this;
    }

    /**
     * Get checkedIn
     *
     * @return boolean 
     */
    public function getCheckedIn()
    {
        return $this->checkedIn;
    }
}
