<?php

namespace Events\EventsBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * TicketRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TicketRepository extends EntityRepository
{
    /**
     * @param $id int
     * @param $checkIn boolean
     */
    public function checkIn($id, $checkIn = true) {
        $ticket = $this->find($id);
        $ticket->setCheckedIn($checkIn);

        $this->getEntityManager()->persist($ticket);
        $this->getEntityManager()->flush();
    }
}