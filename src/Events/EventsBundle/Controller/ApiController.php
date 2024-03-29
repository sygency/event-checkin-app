<?php

namespace Events\EventsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends Controller
{
    /**
     * @Route("/api/check_in")
     * @Method({"POST"})
     */
    public function checkInAction(Request $request) {
        $em = $this->get('doctrine.orm.entity_manager');
        $ticketRepository = $em->getRepository('EventsBundle:Ticket');
        $seatRepository = $em->getRepository('EventsBundle:Seat');

        $seatName = $request->request->get('code');
        $seat = $seatRepository->findBySeatName($seatName);

        if ($seat) {
            foreach ($seat->getTickets() as $ticket) {
            	if($ticket->getCheckedIn()) {
            		return new JsonResponse(array(
            				'status' => 'Warning',
            				'message' => 'Already checked in',
            				'seat' => $ticket->getSeat()->getName(),
            				'zone' => $ticket->getSeat()->getZone()->getTitle()
            		));
            	} else {
	                $ticketRepository->checkIn($ticket->getId());
	
	                return new JsonResponse(array(
	                    'status' => 'ok',
	                    'message' => '',
	                    'seat' => $ticket->getSeat()->getName(),
	                    'zone' => $ticket->getSeat()->getZone()->getTitle()
	                ));
            	}
            }
        } else {
            return new JsonResponse(array(
                'status' => 'error',
                'message' => 'Ticket not found',
                'seat' => '',
                'zone' => ''
            ));
        }
    }
}
