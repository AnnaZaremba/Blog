<?php

namespace AppBundle\Controller;

use AppBundle\Repository\Doctrine\KategoriaRepository;
use AppBundle\Repository\Doctrine\WpisRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route(service="app.kategorie_controller")
 */
class KategorieController extends Controller
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
     * @Route("/kategoria{id}", name="kategoriaid", requirements={"id": "\d+"})
     * @Template()
     *
     * @param int $id
     * @return array
     */
    public function znajdzAction($id)
    {
        return [
            'kategoria' =>  $this->kategoriaRepository->getOneById($id),
            'wpisy' => $this->kategoriaRepository->getOneById($id)->getWpisy(),
            'kategorie' =>  $this->kategoriaRepository->getAllOrderByName(),
        ];
    }
}