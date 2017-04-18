<?php

namespace AppBundle\Repository\Doctrine;

use AppBundle\Entity\Kategoria;
use AppBundle\Entity\Wpis as WpisEntity;
use AppBundle\Form\Model\Wpis;

class WpisRepository extends DoctrineRepository
{
    public function getAllOrderByName()
    {
        return $this->getEntityManager()
            ->getRepository('AppBundle:Wpis')
            ->findBy([], ['temat' => 'ASC']);
    }

    public function getOneById($id)
    {
        return $this->getEntityManager()
            ->getRepository('AppBundle:Wpis')
            ->find($id);
    }

    public function getLast()
    {
        return $this->getEntityManager()
            ->getRepository('AppBundle:Wpis')
            ->findOneBy([], ['id' => 'DESC']);
    }

    protected function getEntityClassName()
    {
        return 'AppBundle:Wpis';
    }

    public function save(Wpis $wpis)
    {
        $em = $this->getEntityManager();

        $wpisBaza = new WpisEntity();
        $wpisBaza->setTemat($wpis->getTemat());
        $wpisBaza->setTresc($wpis->getTresc());
        /** @var Kategoria $kategoria */
        foreach ($wpis->getKategorie() as $kategoria) {
            $wpisBaza->addKategoria($kategoria);
        }

        $em->persist($wpisBaza);
        $em->flush();
    }

    public function update(Wpis $wpis)
    {
        $em = $this->getEntityManager();
        /** @var WpisEntity $wpisBaza */
        $wpisBaza = $this->find($wpis->getId());

        $wpisBaza->setTemat($wpis->getTemat());
        $wpisBaza->setTresc($wpis->getTresc());

        //usuniecie
        $wpisBaza->removeKategorie();

        /** @var Kategoria $kategoria */
        foreach ($wpis->getKategorie() as $kategoria) {
            $wpisBaza->addKategoria($kategoria);
        }

        $em->persist($wpisBaza);
        $em->flush();
    }

    public function delete($id)
    {
        $wpisBaza = $this->find($id);
        $wpisBaza->removeKategorie();
        $em = $this->getEntityManager();
        $em->remove($wpisBaza);
        $em->flush();
    }
}