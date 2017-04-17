<?php
namespace AppBundle\Form\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

class Wpis
{
    private $id;

    /**
     * @var integer
     */
    private $createat;

    /**
     * @var string
     * @Assert\NotBlank(message="Pole nie może być puste.")
     */
    private $temat;

    /**
     * @var string
     * @Assert\NotBlank(message="Pole nie może być puste.")
     */
    private $tresc;

    /**
     * @var ArrayCollection
     */
    private $kategorie;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getCreateat()
    {
        return $this->createat;
    }

    /**
     * @param int $createat
     */
    public function setCreateat($createat)
    {
        $this->createat = $createat;
    }

    /**
     * @return string
     */
    public function getTemat()
    {
        return $this->temat;
    }

    /**
     * @param string $temat
     */
    public function setTemat($temat)
    {
        $this->temat = $temat;
    }

    /**
     * @return string
     */
    public function getTresc()
    {
        return $this->tresc;
    }

    /**
     * @param string $tresc
     */
    public function setTresc($tresc)
    {
        $this->tresc = $tresc;
    }

    /**
     * @return ArrayCollection
     */
    public function getKategorie()
    {
        return $this->kategorie;
    }

    /**
     * @param ArrayCollection $kategorie
     */
    public function setKategorie($kategorie)
    {
        $this->kategorie = $kategorie;
    }
}