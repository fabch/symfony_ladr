<?php

namespace LADR\CompanyBundle\Model;

use AppBundle\Entity\Company;
use Doctrine\Common\Collections\Collection;

interface CompanyInterface
{
    /**
     * @param int $id
     */
    public function setId($id);

    /**
     * get lft
     *
     * @return int
     */
    public function getLft();

    /**
     * get lvl
     *
     * @return int
     */
    public function getLvl();

    /**
     * get rgt
     *
     * @return int
     */
    public function getRgt();

    /**
     * get root
     *
     * @return mixed
     */
    public function getRoot();

    /**
     * Set parent
     *
     * @param Company $parent
     *
     * @return CompanyInterface
     */
    public function setParent(Company $parent = null);

    /**
     * Get parent
     *
     * @return Company
     */
    public function getParent();

    /**
     * Get children
     *
     * @return Collection|Company[]
     */
    public function getChildren();

    /**
     * set Children
     *
     * @param Collection|Company[] $children
     */
    public function setChildren(Collection $children);

    /**
     * Add child
     *
     * @param Company $child
     *
     * @return CompanyInterface
     */
    public function addChild(Company $child);

    /**
     * Remove child
     *
     * @param Company $child
     */
    public function removeChild(Company $child);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getSiret();

    /**
     * @param string $siret
     */
    public function setSiret($siret);

    /**
     * @return string
     */
    public function getTvanum();

    /**
     * @param string $tvanum
     */
    public function setTvanum($tvanum);

    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $code
     */
    public function setCode($code);

    /**
     * @return string
     */
    public function getWeb();

    /**
     * @param string $web
     */
    public function setWeb($web);

}