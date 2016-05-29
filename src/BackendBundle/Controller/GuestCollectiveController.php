<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\GuestCollective;
use AppBundle\Entity\Guest;

/**
 * @author Florian Weber <florian.weber@fweber.info>
 */
class GuestCollectiveController extends Controller
{
    public function collectionAction()
    {
        $guests = $this->getDoctrine()->getRepository('AppBundle:GuestCollective')->findAll();

        return $this->render('BackendBundle:GuestCollective:collection.html.twig', [
            'guests' => $guests,
        ]);
    }

    public function createAction(Request $request)
    {
        if($request->get('sent', 0) == 1) {
            $gc = new GuestCollective();
            $gc
                ->setTitle($request->get('title'))
                ->setCode(base_convert(time(), 10, 36))
            ;

            $em = $this->getDoctrine()->getManager();
            $em->persist($gc);
            $em->flush();

            return $this->redirectToRoute('guest_collective_add_guest', ['id' => $gc->getId()]);
        }

        return $this->render('BackendBundle:GuestCollective:create.html.twig');
    }

    public function updateAction(Request $request, $id)
    {
        $gc = $this->getDoctrine()->getRepository('AppBundle:GuestCollective')->findOneById($id);

        if(!$gc) {
            throw new \Exception('not found');
        }

        if($request->get('sent', 0) == 1) {
            $gc
                ->setTitle($request->get('title'))
            ;

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('guest_collective_collection');
        }

        return $this->render('BackendBundle:GuestCollective:update.html.twig', [
            'gc' => $gc,
        ]);
    }

    public function deleteAction(Request $request, $id)
    {
        $gc = $this->getDoctrine()->getRepository('AppBundle:GuestCollective')->findOneById($id);

        if(!$gc) {
            throw new \Exception('not found');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($gc);
        $em->flush();

        return $this->redirectToRoute('guest_collective_collection');
    }

    public function addGuestAction(Request $request, $id)
    {
        $gc = $this->getDoctrine()->getRepository('AppBundle:GuestCollective')->findOneById($id);

        if(!$gc) {
            throw new \Exception('not found');
        }

        if($request->get('sent', 0) == 1) {
            $guest = new Guest();
            $guest
                ->setName($request->get('name'))
                ->setIsGoing(false)
                ->setCollective($gc)
            ;

            $em = $this->getDoctrine()->getManager();
            $em->persist($guest);
            $em->flush();

            return $this->redirectToRoute('guest_collective_add_guest', ['id' => $gc->getId()]);
        }

        return $this->render('BackendBundle:GuestCollective:add_guest.html.twig');
    }

    public function updateGuestAction(Request $request, $id, $gid)
    {
        $gc = $this->getDoctrine()->getRepository('AppBundle:GuestCollective')->findOneById($id);

        if(!$gc) {
            throw new \Exception('not found');
        }

        $guest = $this->getDoctrine()->getRepository('AppBundle:Guest')->findOneById($gid);

        if(!$guest) {
            throw new \Exception('not found');
        }

        if($request->get('sent', 0) == 1) {
            $guest
                ->setName($request->get('name'))
            ;

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('guest_collective_collection');
        }

        return $this->render('BackendBundle:GuestCollective:update_guest.html.twig', [
            'g' => $guest,
        ]);
    }

    public function deleteGuestAction(Request $request, $id, $gid)
    {
        $gc = $this->getDoctrine()->getRepository('AppBundle:GuestCollective')->findOneById($id);

        if(!$gc) {
            throw new \Exception('not found');
        }

        $guest = $this->getDoctrine()->getRepository('AppBundle:Guest')->findOneById($gid);

        if(!$guest) {
            throw new \Exception('not found');
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($guest);
        $em->flush();

        return $this->redirectToRoute('guest_collective_collection');
    }
}
