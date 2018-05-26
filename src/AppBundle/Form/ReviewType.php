<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Doctrine\DBAL\Types\DateType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class ReviewType extends AbstractType
{
    /**
     * {@inheritdoc} Including all fields from Review entity.
     */

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text', TextareaType::class, array('attr' => array('maxlenght' => 250, 'label' => 'Description')))
            ->add('publicationDate', \Symfony\Component\Form\Extension\Core\Type\DateType::class, array('data' => new\DateTime('now')))
            ->add('note', IntegerType::class, array('attr' => array('min' => 0, 'max' => 5, 'label' => 'Note')))
            ->add('userRated', EntityType::class, array(
                'class' => User::class,
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.lastName','ASC');
                },
                'choice_label' => 'lastName'))
            ->add('reviewAuthor');
    }

    /**
     * {@inheritdoc} Targeting Review entity
     */

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Review'
        ));
    }

    /**
     * {@inheritdoc} getName() is now deprecated
     */

    public function getBlockPrefix()
    {
        return 'appbundle_review';
    }


}
