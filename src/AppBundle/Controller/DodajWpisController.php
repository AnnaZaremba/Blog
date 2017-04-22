<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Wpis as WpisEntity;
use AppBundle\Form\Model\Wpis;
use AppBundle\Form\Type\WpisType;
use AppBundle\Repository\Doctrine\KategoriaRepository;
use AppBundle\Repository\Doctrine\WpisRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DodajWpisController
 * @package AppBundle\Controller
 * @Route(service="app.dodaj_wpis_controller")
 */
class DodajWpisController extends Controller
{
    /** @var KategoriaRepository */
    private $kategoriaRepository;

    /** @var WpisRepository */
    private $wpisRepository;

    /**
     * @param KategoriaRepository $kategoriaRepository
     * @param WpisRepository $wpisRepository
     */
    public function __construct(KategoriaRepository $kategoriaRepository, WpisRepository $wpisRepository)
    {
        $this->kategoriaRepository = $kategoriaRepository;
        $this->wpisRepository = $wpisRepository;
    }

    /**
     * @Route("/dodajwpis", name="dodajwpis")
     * @Template()
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function dodajWpisAction(Request $request)
    {
        $wpis = new Wpis();
        $form = $this->createForm(WpisType::class, $wpis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->wpisRepository->save($wpis);
            return $this->redirectToRoute('wpisdodany');

        }

        $find = $this->getDoctrine()
            ->getRepository('AppBundle:Wpis')
            ->findAll();

        return array(
            'form' => $form->createView(),
            'wpis' => $wpis,
            'find' => $find,
            'kategorie' => $this->kategoriaRepository->getAllOrderByName(),
            'wpisy' => $this->wpisRepository->getAllOrderByName(),
        );
    }

    /**
     * @Route("/wpisdodany", name="wpisdodany")
     */
    public function wpisDodanyAction()
    {
        return $this->redirectToRoute('dodajwpis');
    }

    /**
     * @Route("/usunwpis", name="usunwpis")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request)
    {
        $id = $request->get('id');

        $this->wpisRepository->delete($id);

        return $this->redirectToRoute('dodajwpis');
    }

    /**
     * @Route("/edytujwpis", name="edytujwpis")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request)
    {
        $id = $request->get('id');
        $wpis = new Wpis();

        if (isset($id)) {
            /** @var WpisEntity $wpisBaza */
            $wpisBaza = $this->getDoctrine()
                ->getRepository('AppBundle:Wpis')
                ->find($id);

            $wpis->setId($wpisBaza->getId());
            $wpis->setTemat($wpisBaza->getTemat());
            $wpis->setTresc($wpisBaza->getTresc());
            $wpis->setKategorie($wpisBaza->getKategorie());
        }

        $form = $this->createForm(WpisType::class, $wpis);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->wpisRepository->update($wpis);

            return $this->redirectToRoute('dodajwpis');
        }

        $dane = $this->getDoctrine()
            ->getRepository('AppBundle:Wpis')
            ->findAll();

        return $this->render('@App/DodajWpis/edytujWpis.html.twig', array(
            'form' => $form->createView(),
            'isValid' => $form->isValid(),
            'wpis' => $wpis,
            'dane' => $dane,
            'kategorie' => $this->kategoriaRepository->getAllOrderByName(),
            'wpisy' => $this->wpisRepository->getAllOrderByName(),
        ));
    }
}