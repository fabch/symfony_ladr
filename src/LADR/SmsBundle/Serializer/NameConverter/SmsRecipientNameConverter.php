<?php
/**
 * @author Fabien Chartrain <fabien.chartrain@gmail.com>
 * @date   : 12/04/17
 * @time   : 14:28
 */
namespace LADR\SmsBundle\Serializer\NameConverter;

use Symfony\Component\Serializer\NameConverter\NameConverterInterface;

class SmsRecipientNameConverter implements NameConverterInterface
{
    public function normalize($propertyName)
    {
        return $propertyName;
    }

    public function denormalize($propertyName)
    {
        switch($propertyName){
            case 0:
                return 'phoneNumber';
                break;
            case 1:
                return 'status';
                break;
            case 2:
                return 'sendAt';
                break;
            case 3:
                return 'updatedAt';
                break;
            case 4:
                return 'detail';
                break;
            case 5:
                return 'sms';
                break;
            case 6:
                return 'operator';
                break;
            default:
                return $propertyName;
        }
    }
}