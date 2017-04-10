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
        return array(
            0 => 'En attente d\'envoi',
            1 => 'Envoyé et bien reçu',
            2 => 'Envoyé et non reçu',
            3 => 'En cours',
            4 => 'Echec',
            5 => 'Expiré'
        );
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