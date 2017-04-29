<?php

namespace AppBundle\Controller;

use AppBundle\Repository\Doctrine\KategoriaRepository;
use AppBundle\Repository\Doctrine\WpisRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route(service="app.default_controller")
 */
class DefaultController extends Controller
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
     * @Route("/", name="homepage")
     * @Template()
     * @return array
     */
    public function startAction()
    {
        return [
            'kategorie' => $this->kategoriaRepository->getAllOrderByName(),
            'wpisy' => $this->wpisRepository->getAll(),
        ];
    }

    /**
     * @Route("/{id}", name="wpisid", requirements={"id": "\d+"})
     * @Template()
     *
     * @param int $id
     * @return array
     */
    public function findAction($id)
    {
        return [
            'kategorie' => $this->kategoriaRepository->getAllOrderByName(),
            'wpis' => $this->wpisRepository->getOneById($id),
        ];
    }

    /**
     * @Route("/omnie", name="omnie")
     * @Template()
     */
    public function omnieAction()
    {
        return [
            'kategorie' => $this->kategoriaRepository->getAllOrderByName(),
        ];
    }
}
