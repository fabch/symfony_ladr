<?php
namespace LADR\AddressBundle\Form\Type;

use LADR\AddressBundle\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MinimalAddressType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', TextType::class,
                array(
                    "label"              => "Prénom",
                    "required"           => false
                )
            )
            ->add('lastName', TextType::class,
                array(
                    "label"              => "Nom",
                    "required"           => false
                )
            )
            ->add('addr', TextType::class,
                array(
                    "label"              => "Adresse",
                    "required"           => true
                )
            )
            ->add('addrComp', TextType::class,
                array(
                    "label"              => "Complément d'adresse",
                    "required"           => false
                )
            )
            ->add('postalCode', TextType::class,
                array(
                    "label"              => "Code postal",
                    "required"           => true
                )
            )
            ->add('city', TextType::class,
                array(
                    "label"              => "Ville",
                    "required"           => true
                )
            )
            ->add('country', CountryType::class,
                array(
                    "label"              => "Pays",
                    "required"           => true
                )
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array());
    }

    public function getParent(){
        return FormType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'minimal_address';
    }
}
