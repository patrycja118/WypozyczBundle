<?php

namespace Patrycja\WypozyczBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;


class OrdersType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('status','choice', array('choices' => array('Niezaplacone' => 'Niezaplacone')))
            ->add('term')
            ->add('form', 'choice', array('choices' => array('Płatność on-line' => 'Płatnośćon-line', 'sms' => 'sms')))
            ->add('conditions', 'choice', array('choices' => array('Dotpay' => 'Dotpay', 'kod sms' => 'kod sms')))
            ->add('MovieId')
            ->add('idCustomer')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Patrycja\WypozyczBundle\Entity\Orders'
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