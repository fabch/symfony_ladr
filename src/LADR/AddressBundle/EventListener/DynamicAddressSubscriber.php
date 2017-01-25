<?php
/**
 * @author Fabien Chartrain <fabien.chartrain@gmail.com>
 * @date: 17/02/16
 * @time: 00:35
 */

namespace LADR\AddressBundle\EventListener;

use Doctrine\Bundle\DoctrineBundle\ManagerConfigurator;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Events;
use Doctrine\ORM\Internal\Hydration\AbstractHydrator;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\ClassMetadataInfo;
use Symfony\Component\DependencyInjection\Container;
use LADR\AddressBundle\Entity\Address;


class DynamicAddressSubscriber implements EventSubscriber
{
    /**
     * @var Container
     */
    private $container;


    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function getSubscribedEvents()
    {
        return array(
            Events::loadClassMetadata,
        );
    }

    /**
     * @param LoadClassMetadataEventArgs $eventArgs
     */
    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        /** @var ClassMetadata $metadata */
        $metadata = $eventArgs->getClassMetadata();
        $traits = $this->container->getParameter("traits");

        foreach($traits as $trait => $params)
        {
            switch($trait)
            {
                case "has_multiple_address":
                    // Check intersections between current class interfaces and interfaces to add dynamic relation
                    if(count(array_intersect(class_implements($metadata->getName()), $params['interfaces'])) > 0)
                    {

                        /** @var AbstractHydrator $namingStrategy */
                        $namingStrategy = $this->container->get('doctrine')->getManager()
                            ->getConfiguration()
                            ->getNamingStrategy()
                        ;

                        $metadata->mapManyToMany(
                            array(
                                'targetEntity'  => Address::CLASS,
                                'fieldName'     => 'addresses',
                                'cascade'       => array('persist'),
                                'joinTable'     => array(
                                    'name'        => strtolower('ladr_' . $namingStrategy->classToTableName($metadata->getName())) . '_addresses',
                                    'joinColumns' => array(
                                        array(
                                            'name'                  => $namingStrategy->joinKeyColumnName($metadata->getName()),
                                            'referencedColumnName'  => $namingStrategy->referenceColumnName(),
                                            'onDelete'  => 'CASCADE',
                                            'onUpdate'  => 'CASCADE'
                                        ),
                                    ),
                                    'inverseJoinColumns' => array(
                                        array(
                                            'name'                  => 'address_id',
                                            'referencedColumnName'  => $namingStrategy->referenceColumnName(),
                                            'onDelete'  => 'CASCADE',
                                            'onUpdate'  => 'CASCADE',
                                        ),
                                    )
                                )
                            )
                        );
                    }
                    break;
            }

        }
    }
}