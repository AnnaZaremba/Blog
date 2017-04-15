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
 */
class DodajWpisController extends Controller
{
    /**
     * @Route("/dodajwpis", name="dodajwpis")
     * @Template()
     */
    public function dodajWpisAction(Request $request)
    {
        $wpis = new Wpis();
        $form = $this->createForm(WpisType::class, $wpis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            (new WpisRepository($this->getDoctrine()->getManager()))->save($wpis);
            return $this->redirectToRoute('wpisdodany');
        }

        $find = $this->getDoctrine()
            ->getRepository('AppBundle:Wpis')
            ->findAll();

        return array(
            'form' => $form->createView(),
            'wpis' => $wpis,
            'find' => $find,
            'kategorie' => (new KategoriaRepository($this->getDoctrine()->getManager()))->getAllOrderByName(),
            'wpisy' => (new WpisRepository($this->getDoctrine()->getManager()))->getAllOrderByName(),
        );
    }

    /**
     * @return array
     *
     * @Route("/wpisdodany", name="wpisdodany")
     * @Template()
     */
    public function wpisDodanyAction()
    {
        return [
            'kategorie' => (new KategoriaRepository($this->getDoctrine()->getManager()))->getAllOrderByName(),
            'wpisy' => (new WpisRepository($this->getDoctrine()->getManager()))->getAllOrderByName(),
        ];
    }

    /**
     * @Route("/usunwpis", name="usunwpis")
     */
    public function deleteAction(Request $request)
    {
        $id = $request->get('id');

        (new WpisRepository($this->getDoctrine()->getManager()))->delete($id);

        return $this->render('@App/DodajWpis/wpisUsuniety.html.twig', array(
            'kategorie' => (new KategoriaRepository($this->getDoctrine()->getManager()))->getAllOrderByName(),
            'wpisy' => (new WpisRepository($this->getDoctrine()->getManager()))->getAllOrderByName(),
        ));
    }

    /**
     * @Route("/edytujwpis", name="edytujwpis")
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

            (new WpisRepository($this->getDoctrine()->getManager()))->update($wpis);

            return $this->render('@App/DodajWpis/WpisZedytowany.html.twig', array(
                'form' => $form->createView(),
                'isValid' => $form->isValid(),
                'wpis' => $wpis,
                'kategorie' => (new KategoriaRepository($this->getDoctrine()->getManager()))->getAllOrderByName(),
                'wpisy' => (new WpisRepository($this->getDoctrine()->getManager()))->getAllOrderByName(),
            ));
        }

        $dane = $this->getDoctrine()
            ->getRepository('AppBundle:Wpis')
            ->findAll();

        return $this->render('@App/DodajWpis/edytujWpis.html.twig', array(
            'form' => $form->createView(),
            'isValid' => $form->isValid(),
            'wpis' => $wpis,
            'dane' => $dane,
            'kategorie' => (new KategoriaRepository($this->getDoctrine()->getManager()))->getAllOrderByName(),
            'wpisy' => (new WpisRepository($this->getDoctrine()->getManager()))->getAllOrderByName(),
        ));
    }
}