<?php
/**
 * @author Fabien Chartrain <fabien.chartrain@gmail.com>
 * @date   : 12/04/17
 * @time   : 14:28
 */
namespace LADR\SmsBundle\Serializer\NameConverter;

use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

class SmsNameConverter implements NameConverterInterface
{
    public function normalize($propertyName)
    {
        switch($propertyName){
            case 'apiKey':
                return 'key';
                break;
            case 'scheduledAt':
                return 'date';
                break;
            default:
                return $propertyName;
        }
    }

    public function denormalize($propertyName)
    {
        switch($propertyName){
            case 'api':
                return 'key';
                break;
            case 'date':
                return 'scheduledAt';
                break;
            default:
                return $propertyName;
        }
    }
}