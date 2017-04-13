<?php
namespace LADR\CompanyBundle\Entity\Traits;

use AppBundle\Entity\Company;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class HasMultipleCompanyTrait
 * @package LADR\CompanyBundle\Entity\Traits
 */
trait HasMultipleCompanyTrait
{
    /**
     * @var Collection|Company[]
     * @ORM\ManyToOne(targetEntity="Company")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $companies;

    /**
     * Get Companies
     *
     * @return Collection|Company[]
     */
    public function getCompanies(){
        return $this->companies;
    }

    /**
     * Set Companies
     *
     * @param Collection|Company[] $companies
     * @return self
     */
    public function setCompanies(Collection $companies){
        return $this->companies = $companies;
    }

    /**
     * Add Company
     *
     * @param Company $company
     * @return self
     */
    public function addCompany(Company $company){
        $this->companies->add($company);
        return $this;
    }

    /**
     * Remove Company
     *
     * @param Company $company
     * @return self
     */
    public function removeCompany(Company $company){
        $this->companies->removeElement($company);
        return $this;
    }
}