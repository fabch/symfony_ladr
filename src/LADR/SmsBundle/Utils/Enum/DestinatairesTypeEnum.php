<?php
namespace LADR\SmsBundle\Utils\Enum;

/**
 * Class DestinatairesTypeEnum
 * @package LADR\SmsBundle\Utils\Enum\DestinatairesTypeEnum
 */
class DestinatairesTypeEnum
{

    const NULLABLE = true;

    /**
     * @return array
     */
    public static function getAvailableValues()
    {
        return array('all','groupe','datas');
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