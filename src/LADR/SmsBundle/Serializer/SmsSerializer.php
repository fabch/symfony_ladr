<?php
/**
 * @author Fabien Chartrain <fabien.chartrain@gmail.com>
 * @date   : 11/04/17
 * @time   : 16:50
 */
namespace LADR\SmsBundle\Serializer;

use Doctrine\Common\Proxy\Exception\UnexpectedValueException;
use LADR\SmsBundle\Model\SmsRecipientAbstract;
use Symfony\Component\DependencyInjection\Exception\LogicException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Serializer;

class SmsSerializer extends Serializer
{

    /**
     * Returns a matching normalizer.
     *
     * @param mixed  $data   Data to get the serializer for
     * @param string $format format name, present to give the option to normalizers to act differently based on formats
     *
     * @return NormalizerInterface|null
     */
    private function getNormalizer($data, $format)
    {
        foreach ($this->normalizers as $normalizer) {
            if ($normalizer instanceof NormalizerInterface && $normalizer->supportsNormalization($data, $format)) {
                return $normalizer;
            }
        }
    }

    /**
     * Returns a matching denormalizer.
     *
     * @param mixed  $data   data to restore
     * @param string $class  the expected class to instantiate
     * @param string $format format name, present to give the option to normalizers to act differently based on formats
     *
     * @return DenormalizerInterface|null
     */
    private function getDenormalizer($data, $class, $format)
    {
        foreach ($this->normalizers as $normalizer) {
            if ($normalizer instanceof DenormalizerInterface && $normalizer->supportsDenormalization($data, $class, $format)) {
                return $normalizer;
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($data, $format = null, array $context = array())
    {
        // If a normalizer supports the given data, use it
        if ($normalizer = $this->getNormalizer($data, $format)) {
            return $normalizer->normalize($data, $format, $context);
        }

        if (null === $data || is_scalar($data)) {
            return $data;
        }

        if (is_array($data) || $data instanceof \Traversable) {

            $normalized = array();
            foreach ($data as $key => $val) {
                $normalized[$key] = $this->normalize($val, $format, $context);
            }
            if($data instanceof \Doctrine\ORM\PersistentCollection && is_subclass_of($data->getTypeClass()->getName(), SmsRecipientAbstract::class)){
                $oldNormalized = $normalized;
                $normalized = array();
                foreach ($oldNormalized as $key => $val) {
                    if(!isset($val['params'])) {
                        $normalized[] = (string)$val['phoneNumber'];
                        continue;
                    }
                    $normalized[(string)$val['phoneNumber']] = $val['params'];
                }
            }
            return $normalized;
        }

        if (is_object($data)) {
            if (!$this->normalizers) {
                throw new LogicException('You must register at least one normalizer to be able to normalize objects.');
            }

            throw new UnexpectedValueException(sprintf('Could not normalize object of type %s, no supporting normalizer found.', get_class($data)));
        }

        throw new UnexpectedValueException(sprintf('An unexpected value could not be normalized: %s', var_export($data, true)));
    }

    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $type, $format = null, array $context = array())
    {
        return $this->denormalizeObject($data, $type, $format, $context);
    }

    /**
     * Denormalizes data back into an object of the given class.
     *
     * @param mixed  $data    data to restore
     * @param string $class   the expected class to instantiate
     * @param string $format  format name, present to give the option to normalizers to act differently based on formats
     * @param array  $context The context data for this particular denormalization
     *
     * @return object
     *
     * @throws LogicException
     * @throws UnexpectedValueException
     */
    private function denormalizeObject($data, $class, $format, array $context = array())
    {
        if (!$this->normalizers) {
            throw new LogicException('You must register at least one normalizer to be able to denormalize objects.');
        }

        if ($normalizer = $this->getDenormalizer($data, $class, $format)) {
            return $normalizer->denormalize($data, $class, $format, $context);
        }

        throw new UnexpectedValueException(sprintf('Could not denormalize object of type %s, no supporting normalizer found.', $class));
    }

}