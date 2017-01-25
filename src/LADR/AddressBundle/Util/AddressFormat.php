<?php
namespace LADR\AddressBundle\Util;

use \LADR\AddressBundle\Entity\Address;
/**
 * @author Fabien Chartrain <fabien.chartrain@gmail.com>
 * @date: 17/01/17
 * @time: 15:23
 */
class AddressFormat
{
    const ADDRESS_FORMAT_FULL = 1;
    const ADDRESS_FORMAT_MEDIUM = 2;
    const ADDRESS_FORMAT_MIN = 3;

    /**
     * @param Address $address
     * @param int $format
     */
    public static function asHtml(Address $address, $format = self::ADDRESS_FORMAT_FULL){

    }

    /**
     * @param Address $address
     * @param int $format
     */
    public static function asText(Address $address, $format = self::ADDRESS_FORMAT_FULL){

    }
}