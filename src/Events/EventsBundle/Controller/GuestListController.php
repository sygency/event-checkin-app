<?php

namespace Events\EventsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GuestListController extends Controller
{
    /**
     * @Route("/", name="base_url")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $ticketRepository = $em->getRepository('EventsBundle:Ticket');
        $tickets = $ticketRepository->findAll();

        return compact('tickets');
    }

    /**
     * @Route("/guest_list/check_in")
     */
    public function checkInAction(Request $request) {
        $em = $this->get('doctrine.orm.entity_manager');
        $ticketRepository = $em->getRepository('EventsBundle:Ticket');

        $ticketId = $request->request->get('ticket_id');
        $ticketRepository->checkIn($ticketId);

        return new JsonResponse(true);
    }

    /**
     * @Route("/guest_list/check_out")
     */
    public function checkOutAction(Request $request) {
        $em = $this->get('doctrine.orm.entity_manager');
        $ticketRepository = $em->getRepository('EventsBundle:Ticket');

        $ticketId = $request->request->get('ticket_id');
        $ticketRepository->checkIn($ticketId, false);

        return new JsonResponse(true);
    }
}
