<?php
namespace LADR\SmsBundle\Utils\Enum;

/**
 * Class SmsTypeEnum
 * @package LADR\SmsBundle\Utils\Enum\SmsTypeEnum
 */
class SmsTypeEnum
{

    const NULLABLE = false;

    /**
     * @return array
     */
    public static function getAvailableValues()
    {
        return array('premium','lowcost');
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public static function isValid($value)
    {
        if($value === null) return self::NULLABLE;
        return in_array($value, self::getAvailableValues());
    }
}