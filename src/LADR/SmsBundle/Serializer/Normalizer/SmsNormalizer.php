<?php
/**
 * @author Fabien Chartrain <fabien.chartrain@gmail.com>
 * @date   : 11/04/17
 * @time   : 14:51
 */
namespace LADR\SmsBundle\Serializer\Normalizer;

use LADR\SmsBundle\Model\SmsAbstract;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\PropertyInfo\PropertyTypeExtractorInterface;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactoryInterface;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class SmsNormalizer extends ObjectNormalizer
{

    public function __construct(ClassMetadataFactoryInterface $classMetadataFactory = null, NameConverterInterface $nameConverter = null, PropertyAccessorInterface $propertyAccessor = null, PropertyTypeExtractorInterface $propertyTypeExtractor = null)
    {
        parent::__construct($classMetadataFactory, $nameConverter, $propertyTypeExtractor);
    }
    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return parent::supportsNormalization($data, $format) && $this->supports(get_class($data));
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        return parent::supportsDenormalization($data, $type, $format) && $this->supports($type);
    }

    /**
     * Checks if the given class extends SmsAbstract::class
     *
     * @param string $class
     *
     * @return bool
     */
    private function supports($class)
    {
        return is_subclass_of($class, SmsAbstract::class);
    }
}