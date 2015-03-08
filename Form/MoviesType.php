<?php

namespace Patrycja\WypozyczBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MoviesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('price')
            ->add('poster')
            ->add('actorTable')
            ->add('specTable')
            ->add('orderTable')
            ->add('reviewTable')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Patrycja\WypozyczBundle\Entity\Movies'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'patrycja_wypozyczbundle_movies';
    }
}
