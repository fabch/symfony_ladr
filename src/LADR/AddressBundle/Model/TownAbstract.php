<?php

namespace LADR\AddressBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class TownAbstract
 * @package LADR\AddressBundle\Entity
 */
class TownAbstract
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="departement", type="string", length=3, nullable=true)
     */
    private $departement;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, nullable=true)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_simple", type="string", length=45, nullable=true)
     */
    private $shortName;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_reel", type="string", length=45, nullable=true)
     */
    private $realName;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_soundex", type="string", length=20, nullable=true)
     */
    private $soundexName;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_metaphone", type="string", length=22, nullable=true)
     */
    private $metaphoneName;

    /**
     * @var string
     *
     * @ORM\Column(name="code_postal", type="string", length=5, nullable=true)
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="commune", type="string", length=3, nullable=true)
     */
    private $township;

    /**
     * @var string
     *
     * @ORM\Column(name="code_commune", type="string", length=5, nullable=true)
     */
    private $townshipCode;

    /**
     * @var int
     *
     * @ORM\Column(name="arrondissement", type="integer", length=3, nullable=true)
     */
    private $borough;

    /**
     * @var string
     *
     * @ORM\Column(name="canton", type="string", length=4, nullable=true)
     */
    private $precinct;

    /**
    * @var string
    *
    * @ORM\Column(name="longitude_grd", type="string", length=9, nullable=true)
    */
    private $longGrd;

    /**
    * @var string
    *
    * @ORM\Column(name="latitude_grd", type="string", length=9, nullable=true)
    */
    private $latGrd;
}