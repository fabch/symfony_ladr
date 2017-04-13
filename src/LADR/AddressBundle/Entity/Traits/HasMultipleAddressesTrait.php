<?php
/**
 * @author Fabien Chartrain <fabien.chartrain@gmail.com>
 * @date: 17/02/16
 * @time: 00:43
 */

namespace LADR\AddressBundle\Entity\Traits;

use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use LADR\AddressBundle\Validator\Constraints as AddressAssert;
use LADR\AddressBundle\Entity\Address;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

trait HasMultipleAddressesTrait {

    /**
     * @var Collection|Address[]
     * @Assert\Valid(traverse="true")
     */
    protected $addresses;


    /**
     * get addresses
     *
     * @return Collection|Address[]
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * set addresses
     *
     * @param Collection|Address[] $addresses
     * @return $this
     */
    public function setAddresses(Collection $addresses)
    {
        $this->addresses = $addresses;
        return $this;
    }

    /**
     * add address
     *
     * @param Address $address
     * @return $this
     */
    public function addAddress(Address $address){
        $this->addresses->add($address);
        return $this;
    }

    /**
     * remove address
     *
     * @param Address $address
     * @return $this
     */
    public function removeAddress(Address $address){
        $this->addresses->removeElement($address);
        return $this;
    }

    /**
     * return default address main
     *
     * @return $this
     */
    public function getDefaultAddressMain()
    {
        return $this->getDefaultAddressByRole(Address::MAIN);
    }

    /**
     * return default address billing
     *
     * @return $this
     */
    public function getDefaultAddressBilling()
    {
        return $this->getDefaultAddressByRole(Address::BILLING);
    }

    /**
     * return default address delivery
     *
     * @return $this
     */
    public function getDefaultAddressDelivery()
    {
        return $this->getDefaultAddressByRole(Address::DELIVERY);
    }

    /**
     * return addresses of type
     *
     * @param int $type
     * @return $this
     */
    public function getAddressesByRole($role)
    {
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq('role', $role));
        return $this->addresses->matching($criteria);
    }

    /**
     * return default address of type
     *
     * @param int $type
     * @return $this
     */
    public function getDefaultAddressByRole($role)
    {
        $criteria = Criteria::create();
        $criteria->where(Criteria::expr()->eq('def_addr', 1));
        $criteria->andWhere(Criteria::expr()->eq('role', $role));
        return $this->addresses->matching($criteria)->first();
    }

    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        if($this->getAddresses()->count()){
            $addrRolesConfig = array_map(function($a){ $a['default'] = 0; $a['total'] = 0; return $a; }, Address::getRoleConfig());
            foreach($this->getAddresses()->toArray() as $address){
                if($address->isDefAddr()) $addrRolesConfig[$address->getRole()]['default']++;
                $addrRolesConfig[$address->getRole()]['total']++;
            }
            foreach($addrRolesConfig as $key => $roleConfig){
                if($roleConfig['min'] > $roleConfig['total']){
                    $context->buildViolation('ladr_address.role.min_addresses')
                        ->setParameter('{{ address_role }}', $key)
                        ->atPath('addresses')
                        ->addViolation();
                }
                if($roleConfig['default'] == 0){
                    $context->buildViolation('ladr_address.role.no_default_addresses')
                        ->setParameter('{{ address_role }}', $key)
                        ->atPath('addresses')
                        ->addViolation();
                }
                elseif($roleConfig['default'] > 1){
                    $context->buildViolation('ladr_address.role.to_much_default_addresses')
                        ->setParameter('{{ address_role }}', $key)
                        ->atPath('addresses')
                        ->addViolation();
                }
            }
        }

    }
}