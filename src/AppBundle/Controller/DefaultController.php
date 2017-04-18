<?php

namespace AppBundle\Controller;

use AppBundle\Repository\Doctrine\KategoriaRepository;
use AppBundle\Repository\Doctrine\WpisRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function startAction(Request $request)
    {
        return [
            'kategorie' => (new KategoriaRepository($this->getDoctrine()->getManager()))->getAllOrderByName(),
            'wpis' => (new WpisRepository($this->getDoctrine()->getManager()))->getLast(),
        ];
    }

    /**
     * @Route("/{id}", name="wpisid", requirements={"id": "\d+"})
     * @Template()
     */
    public function findAction($id)
    {
        return [
            'wpis' => (new WpisRepository($this->getDoctrine()->getManager()))->getOneById($id),
            'kategorie' => (new KategoriaRepository($this->getDoctrine()->getManager()))->getAllOrderByName(),
            'wpisy' => (new WpisRepository($this->getDoctrine()->getManager()))->getAllOrderByName(),
        ];
    }

    /**
     * @Route("/omnie", name="omnie")
     * @Template()
     */
    public function omnieAction(Request $request)
    {
        return [
            'kategorie' => (new KategoriaRepository($this->getDoctrine()->getManager()))->getAllOrderByName(),
        ];
    }
}
