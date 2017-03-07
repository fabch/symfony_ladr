<?php
/**
 * @author Fabien Chartrain <fabien.chartrain@gmail.com>
 * @date   : 06/03/17
 * @time   : 13:57
 */
namespace LADR\SmsBundle\Utils\Errors;

class SpotHitErrorCode
{
    public static $codeList = array(
        1 => "Type de message non spécifié ou incorrect (paramètre \"type\")",
        2 => "Le message est vide",
        3 => "Le message contient plus de 160 caractères",
        4 => "Aucun destinataire valide n'est renseigné",
        5 => "Numéro interdit: seuls les envois en France Métropolitaine sont autorisés pour les SMS Low Cost",
        6 => "Numéro de destinataire invalide",
        7 => "Votre compte n'a pas de formule définie",
        8 => "SMS : L'expéditeur ne peut contenir que 11 caractères | EMAIL : L'e-mail d'expédition est invalide.",
        9 => "Le système a rencontré une erreur, merci de nous contacter.",
        10 => "Vous ne disposez pas d'assez de SMS pour effectuer cet envoi.",
        11 => "L'envoi des message est désactivé pour la démonstration.",
        12 => "Votre compte a été suspendu. Contactez-nous pour plus d'informations",
        13 => "Votre limite d'envoi paramétrée est atteinte. Contactez-nous pour plus d'informations.",
        14 => "Votre limite d'envoi paramétrée est atteinte. Contactez-nous pour plus d'informations.",
        15 => "Votre limite d'envoi paramétrée est atteinte. Contactez-nous pour plus d'informations.",
        16 => "Le paramètre \"smslongnbr\" n'est pas cohérent avec la taille du message envoyé.",
        17 => "L'expéditeur n'est pas autorisé.",
        18 => "EMAIL : Le sujet est trop court.",
        19 => "EMAIL : L'e-mail de réponse est invalide.",
        20 => "EMAIL : Le nom d'expéditeur est trop court.",
        21 => "Token invalide. Contactez-nous pour plus d'informations.",
        22 => "Durée du message non autorisée. Contactez-nous pour plus d'informations.",
        30 => "Clé API non reconnue."
    );

    /**
     * @param int $code
     *
     * @return bool
     */
    public static function getMessage($code){

        if(!in_array($code, array_keys(self::$codeList))){
            throw InvalidErrorCode();
        }

        return self::$codeList[$code];

    }

}