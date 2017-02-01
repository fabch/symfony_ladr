<?php
namespace LADR\CompanyBundle\Entity\Traits;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Gedmo\Mapping\Annotation as Gedmo;
use \Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use AppBundle\Entity\Company;

/**
 * Class CompanyTrait
 *
 * @package LADR\CompanyBundle\Entity\Traits
 */
trait CompanyTrait
{

    /**
     * @var int
     *
     * @Gedmo\TreeLeft
     * @ORM\Column(type="integer")
     */
    protected $lft;

    /**
     * @var int
     *
     * @Gedmo\TreeLevel
     * @ORM\Column(type="integer")
     */
    protected $lvl;

    /**
     * @var int
     *
     * @Gedmo\TreeRight
     * @ORM\Column(type="integer")
     */
    protected $rgt;

    /**
     * @var Company
     *
     * @Gedmo\TreeRoot
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE")
     */
    protected $root;

    /**
     * @var Company
     *
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="children")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE")
     */
    protected $parent;

    /**
     * @var Collection|Company[]
     *
     * @ORM\OneToMany(targetEntity="Company", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    protected $children;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string",length=255)
     * @Assert\NotBlank(message="Le nom de la société ne doit pas être vide")
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="siret", type="string",length=18, nullable=true)
     * @Assert\Luhn(message="Le numéro de siret n'est pas valide")
     */
    protected $siret;

    /**
     * @var int
     *
     * @ORM\Column(name="tvanum", type="string",length=16, nullable=true)
     */
    protected $tvanum;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string",length=255, unique=true)
     */
    protected $code;

    /**
     * @var string
     *
     * @ORM\Column(name="web", type="string",length=255, nullable=true)
     * @Assert\Url(message="L'adresse du site n'est pas valide")
     */
    protected $web;

    /**
     * get id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * set id
     *
     * @param mixed $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * get lft
     *
     * @return mixed
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * set lft
     *
     * @param mixed $lft
     *
     * @return self
     */
    public function setLft($lft)
    {
        $this->lft = $lft;

        return $this;
    }

    /**
     * get lvl
     *
     * @return mixed
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * set lvl
     *
     * @param mixed $lvl
     *
     * @return self
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;

        return $this;
    }

    /**
     * get rgt
     *
     * @return mixed
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * set rgt
     *
     * @param mixed $rgt
     *
     * @return self
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;

        return $this;
    }

    /**
     * get root
     *
     * @return Company
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * set root
     *
     * @param Company $root
     *
     * @return self
     */
    public function setRoot($root)
    {
        $this->root = $root;

        return $this;
    }

    /**
     * get parent
     *
     * @return Company
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * set parent
     *
     * @param Company $parent
     *
     * @return self
     */
    public function setParent(Company $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get children
     *
     * @return Collection|Company[]
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * set Children
     *
     * @param Collection|Company[] $children
     */
    public function setChildren(Collection $children)
    {
        return $this->children = $children;
    }

    /**
     * Add child
     *
     * @param Company $child
     *
     * @return Company
     */
    public function addChild(Company $child)
    {
        $this->children->add($child);

        return $this;
    }

    /**
     * Remove child
     *
     * @param Company $child
     */
    public function removeChild(Company $child)
    {
        $this->children->removeElement($child);

        return $this;
    }

    /**
     * get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * set name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * get siret
     *
     * @return string
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * set siret
     *
     * @param string $siret
     *
     * @return self
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * get tvanum
     *
     * @return int
     */
    public function getTvanum()
    {
        return $this->tvanum;
    }

    /**
     * set tvanum
     *
     * @param int $tvanum
     *
     * @return self
     */
    public function setTvanum($tvanum)
    {
        $this->tvanum = $tvanum;

        return $this;
    }

    /**
     * get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * set code
     *
     * @param string $code
     *
     * @return self
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * get web
     *
     * @return mixed
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * set web
     *
     * @param mixed $web
     *
     * @return self
     */
    public function setWeb($web)
    {
        $this->web = $web;

        return $this;
    }



}
