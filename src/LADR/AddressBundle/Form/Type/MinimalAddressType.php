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
                    "label"              => "form.address.first_name",
                    "required"           => false
                )
            )
            ->add('addr', TextType::class,
                array(
                    "label"              => "form.addr",
                    "required"           => true
                )
            )
            ->add('addrComp', TextType::class,
                array(
                    "label"              => "form.addrComp",
                    "required"           => false
                )
            )
            ->add('postalCode', TextType::class,
                array(
                    "label"              => "form.postalCode",
                    "required"           => true
                )
            )
            ->add('city', TextType::class,
                array(
                    "label"              => "form.city",
                    "required"           => true
                )
            )
            ->add('country', CountryType::class,
                array(
                    "label"              => "form.country",
                    "required"           => true
                )
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'inherit_data' => true
        ));
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
