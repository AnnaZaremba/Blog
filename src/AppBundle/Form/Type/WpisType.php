<?php
namespace AppBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class WpisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', HiddenType::class)
            ->add('createat', IntegerType::class)
            ->add('temat', TextType::class)
            ->add('treść', TextareaType::class)
            ->add('kategorie', EntityType::class, [
                'class' => 'AppBundle:Kategoria',
                'choice_label' => 'temat',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => true,
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->groupBy('u.id')
                        ->orderBy('u.createat', 'ASC');
                },
            ]);
    }
}