<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OrderBy;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ORM\Entity
 * @ORM\Table(name="kategoria")
 */
class Kategoria
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
    private $nazwa;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Wpis", inversedBy="kategorie", cascade={"persist"})
     * @ORM\JoinTable(name="wpiskategoria")
     * @OrderBy({"temat" = "ASC"})
     */
    private $wpisy;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createat;

    /**
     * Kategoria constructor.
     */
    public function __construct()
    {
        $this->wpisy = new ArrayCollection();
        $this->createat = new \DateTime();
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
    public function getNazwa()
    {
        return $this->nazwa;
    }

    /**
     * @param mixed $nazwa
     */
    public function setNazwa($nazwa)
    {
        $this->nazwa = $nazwa;
    }

    /**
     * @return mixed
     */
    public function getWpisy()
    {
        return $this->wpisy;
    }

    /**
     * @param ArrayCollection $wpisy
     */
    public function setWpisy(ArrayCollection $wpisy)
    {
        $this->wpisy = $wpisy;
    }

    public function addWpis(Wpis $wpis)
    {
        $this->wpisy[] = $wpis;
    }

    public function removeWpis(Wpis $wpis)
    {
        $this->wpisy->removeElement($wpis);
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
}