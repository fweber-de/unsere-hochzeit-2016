<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author Florian Weber <florian.weber@fweber.info>
 */
class PageController extends Controller
{
    public function landingAction()
    {
        return $this->render('Page/landing.html.twig');
    }

    public function accessAction(Request $request)
    {
        if(strlen($request->get('code')) == 0) {
            throw new \Exception('bad code');
        }

        $gc = $this->getDoctrine()->getRepository('AppBundle:GuestCollective')->findOneByCode($request->get('code'));

        if(!$gc) {
            throw new \Exception('not found');
        }

        return $this->render('Page/access.html.twig', [
            'gc' => $gc,
        ]);
    }

    public function accessConfirmAction(Request $request)
    {
        if(strlen($request->get('code')) == 0) {
            throw new \Exception('bad code');
        }

        $gc = $this->getDoctrine()->getRepository('AppBundle:GuestCollective')->findOneByCode($request->get('code'));

        if(!$gc) {
            throw new \Exception('not found');
        }

        if($gc->getIsConfirmed() == true) {
            throw new \Exception('already confirmed');
        }

        $gids = json_decode($request->get('guests'));
        foreach ($gids as $gid) {
            $guest = $this->getDoctrine()->getRepository('AppBundle:Guest')->findOneById($gid);

            if(!is_null($guest)) {
                $guest->setIsGoing(true);
            }
        }

        if($request->get('comment', '') != '') {
            $gc->setComment($request->get('comment'));
        }

        $gc->setIsConfirmed(true);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return new Response(json_encode(true), 200, ['Content-Type' => 'application/json']);
    }
}
