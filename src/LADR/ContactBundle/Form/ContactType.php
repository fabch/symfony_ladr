<?php

namespace LADR\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class,array(
                'required' => true
            ))
            ->add('lastName', TextType::class,array(
                'required' => true
            ))
            ->add('email', TextType::class,array(
                'required' => true
            ))
            ->add('mobile', TextType::class,array(
                'required' => false
            ))
            ->add('phone', TextType::class,array(
                'required' => false
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LADR\ContactBundle\Model\ContactInterface'
        ));
    }
}
