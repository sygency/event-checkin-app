<?php

namespace Events\EventsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GuestListController extends Controller
{
    /**
     * @Route("/", name="base_url")
     * @Method({"GET"})
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $ticketRepository = $em->getRepository('EventsBundle:Ticket');
        $tickets = $ticketRepository->findAll();
        $progress = $ticketRepository->getCheckedInPercentage();
        $ticketCount = $ticketRepository->getTicketCount();
        $checkedInTicketCount = $ticketRepository->getCheckedInCount();

        return compact('tickets', 'progress', 'ticketCount', 'checkedInTicketCount');
    }

    /**
     * @Route("/guest_list/check_in")
     * @Method({"POST"})
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
     * @Method({"POST"})
     */
    public function checkOutAction(Request $request) {
        $em = $this->get('doctrine.orm.entity_manager');
        $ticketRepository = $em->getRepository('EventsBundle:Ticket');

        $ticketId = $request->request->get('ticket_id');
        $ticketRepository->checkIn($ticketId, false);

        return new JsonResponse(true);
    }

    /**
     * @Route("/guest_list/update")
     * @Method({"POST"})
     */
    public function updateAction(Request $request) {
        $em = $this->get('doctrine.orm.entity_manager');
        $ticketRepository = $em->getRepository('EventsBundle:Ticket');

        $ticketIds = $request->request->get('ticket_ids');
        $tickets = $ticketRepository->findAllByIds($ticketIds);

        $response = array();
        foreach ($tickets as $ticket) {
            $response[$ticket->getId()] = $ticket->getCheckedIn();
        }

        return new JsonResponse($response);
    }

    /**
     * @Route("/guest_list/progress")
     * @Method({"POST"})
     */
    public function progressAction() {
        $em = $this->get('doctrine.orm.entity_manager');
        $ticketRepository = $em->getRepository('EventsBundle:Ticket');
        $progress = $ticketRepository->getCheckedInPercentage();
        $ticketCount = $ticketRepository->getTicketCount();
        $checkedInTicketCount = $ticketRepository->getCheckedInCount();

        return new JsonResponse(compact('progress', 'ticketCount', 'checkedInTicketCount'));
    }
}
