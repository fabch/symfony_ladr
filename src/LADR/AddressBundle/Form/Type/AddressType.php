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

class AddressType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('role', ChoiceType::class,
                array(
                    'choices'            => Address::getRoleList(),
                    "choice_translation_domain" => "LADRAddressBundle",
                    "label"                     => "form.address.role",
                    "multiple"                  => false,
                    "expanded"                  => false,
                    "required"                  => true
                )
            )
            ->add('professional', CheckboxType::class,
                array(
                    "label"              => "form.address.professional",
                    "required"           => false
                )
            )
            ->add('defAddr', CheckboxType::class,
                array(
                    "label"              => "form.address.def_addr",
                    "required"           => false
                )
            )
            ->add('name', TextType::class,
                array(
                    "label"              => "form.address.name",
                    "required"           => true
                )
            )
            ->add('lastname', TextType::class,
                array(
                    "label"              => "form.address.lastname",
                    "required"           => false
                )
            )
            ->add('firstname', TextType::class,
                array(
                    "label"              => "form.address.firstname",
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
            )
            ->add('phone', TextType::class,
                array(
                    "label"              => "form.phone",
                    "required"           => false
                )
            )
            ->add('mobile', TextType::class,
                array(
                    "label"              => "form.mobile",
                    "required"           => false
                )
            )
            ->add('fax', TextType::class,
                array(
                    "label"              => "form.fax",
                    "required"           => false
                )
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LADR\AddressBundle\Entity\Address',
            'label' => 'form.address'
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
        return 'address';
    }
}
