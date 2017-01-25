<?php

namespace LADR\SecurityBundle\Form;

use Doctrine\ORM\EntityManager;
use LADR\SecurityBundle\Entity\Access;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use LADR\SecurityBundle\Model\SecureContactInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\Role\RoleHierarchy;

/**
 * Class AccessType
 * @package LADR\SecurityBundle\Form
 * @TODO: Brider la sélection des rôles pour n'afficher que les rôles sous le role du user courant
 */
class AccessType extends AbstractType
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var array
     */
    private $roles;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em, TokenStorageInterface $tokenStorage, $roles){
        $this->em = $em;
        $this->tokenStorage = $tokenStorage;
        $this->roles = $roles;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $availablesRoles = $this->getAvailableRoles();

        $builder
            ->add('roles', ChoiceType::class, array(
                'choices'  => array_combine(array_values($availablesRoles), array_values($availablesRoles)),
                'multiple' => true,
                'expanded' => false,
                'required' => true
            ));
        if (in_array('Register', $options['validations_group'])){
            $builder
                ->add('username', TextType::class)
                ->add('plainPassword', RepeatedType::class, array(
                        'type'           => PasswordType::class,
                        'first_options'  => array('label' => 'Password'),
                        'second_options' => array('label' => 'Repeat Password'),
                    )
                );
        }
    }

    protected function getAvailableRoles(){
        $roleHierarchy = new RoleHierarchy($this->roles);
        $roles = $roleHierarchy->getReachableRoles(array_map(function($role){ return new Role($role); }, $this->getAccess()->getRoles() ?: array() ));
        return array_map(function(Role $role) { return $role->getRole(); }, $roles);
    }

    /**
     * @return Access|void
     */
    protected function getAccess()
    {
        if (null === $token = $this->tokenStorage->getToken())  return false;
        if (!is_object($access = $token->getUser())) return false;
        return $access;
    }


    public function getName(){
        return 'security_access';
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'        => 'LADR\SecurityBundle\Model\AccessInterface',
            'validations_group' => array('Edit')
        ));
    }
}
