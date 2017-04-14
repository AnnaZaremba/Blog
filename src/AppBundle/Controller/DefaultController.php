<?php

namespace AppBundle\Controller;

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
        return [];
    }

    /**
     * @Route("/omnie", name="omnie")
     * @Template()
     */
    public function omnieAction(Request $request)
    {
        return [];
    }

    /**
     * @Route("/notatnik", name="notatnik")
     * @Template()
     */
    public function notatnikAction(Request $request)
    {
        return [];
    }

}
