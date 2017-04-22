<?php
namespace AppBundle\Controller;

use AppBundle\Repository\Doctrine\KategoriaRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class KategorieController
 * @package AppBundle\Controller
 * @Route("/kategorie")
 * @Route(service="app.kategorie_controller")
 */
class KategorieController extends Controller
{
    /** @var KategoriaRepository */
    private $kategoriaRepository;

    /**
     * @param KategoriaRepository $kategoriaRepository
     */
    public function __construct(KategoriaRepository $kategoriaRepository)
    {
        $this->kategoriaRepository = $kategoriaRepository;
    }

    /**
     * @Route("/{id}", name="kategoriaid", requirements={"id": "\d+"})
     * @Template()
     * @param $id
     * @return array
     */
    public function findAction($id)
    {
        return [
            'kategoria' => $this->kategoriaRepository->getOneById($id),
            'wpisy' => $this->kategoriaRepository->getOneById($id)->getWpisy(),
            'kategorie' => $this->kategoriaRepository->getAllOrderByName(),
        ];
    }
}