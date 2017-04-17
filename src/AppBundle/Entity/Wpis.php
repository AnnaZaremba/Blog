<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="wpis")
 */
class Wpis
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $createat;

    /**
     * @ORM\Column(type="string")
     */
    private $temat;

    /**
     * @ORM\Column(type="string")
     */
    private $tresc;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Kategoria", mappedBy="wpisy", cascade={"all"})
     * @ORM\JoinTable(name="wpiskategoria")
     */
    private $kategorie;

    /**
     * Przepis constructor.
     */
    public function __construct()
    {
        $this->kategorie = new ArrayCollection();
    }

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
     * @return mixed
     */
    public function getTemat()
    {
        return $this->temat;
    }

    /**
     * @param mixed $temat
     */
    public function setTemat($temat)
    {
        $this->temat = $temat;
    }

    /**
     * @return mixed
     */
    public function getTresc()
    {
        return $this->tresc;
    }

    /**
     * @param mixed $tresc
     */
    public function setTresc($tresc)
    {
        $this->tresc = $tresc;
    }

    /**
     * @return mixed
     */
    public function getCreateat()
    {
        return $this->createat;
    }

    /**
     * @param mixed $createat
     */
    public function setCreateat($createat)
    {
        $this->createat = $createat;
    }

    /**
     * @return mixed
     */
    public function getKategorie()
    {
        return $this->kategorie;
    }

    /**
     * @param ArrayCollection $kategorie
     */
    public function setKategorie(ArrayCollection $kategorie)
    {
        $this->kategorie = $kategorie;
    }

    public function addKategoria(Kategoria $kategoria)
    {
        $kategoria->addWpis($this);
        $this->kategorie[] = $kategoria;
    }

    public function removeKategorie()
    {
        /** @var Kategoria $kategoria */
        foreach ($this->kategorie as $kategoria) {
            $kategoria->removeWpis($this);
        }
        $this->kategorie = new ArrayCollection();
    }

}