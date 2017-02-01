<?php

namespace LADR\CompanyBundle\Model;

use AppBundle\Entity\Company;
use Doctrine\Common\Collections\Collection;

/**
 * Interface HasMultipleCompanyInterface
 * @package LADR\CompanyBundle\Model
 */
interface HasMultipleCompanyInterface
{
    /**
     * Get Companies
     *
     * @return Collection|Company[]
     */
    public function getCompanies();

    /**
     * Set Companies
     *
     * @param Collection|Company[] $companies
     * @return self
     */
    public function setCompanies(Collection $companies);

    /**
     * Add Company
     *
     * @param Company $company
     * @return self
     */
    public function addCompany(Company $company);

    /**
     * remove Company
     *
     * @param Company $company
     * @return self
     */
    public function removeCompany(Company $company);

}