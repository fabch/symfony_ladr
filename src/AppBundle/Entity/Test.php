<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 *
 * @ORM\Table(name="test")
 * @ORM\Entity()
 */
class Test
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    protected $email;

    /**
     * @var array
     *
     * @ORM\Column(name="infos", type="json_array")
     */
    protected $infos;

    /**
     * @var \Datetime
     *
     * @ORM\Column(name="plv", type="datetime", nullable=true)
     */
    protected $plv;

    /**
     * get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * set email
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * get infos
     *
     * @return array
     */
    public function getInfos()
    {
        return $this->infos;
    }

    /**
     * set infos
     *
     * @param array $infos
     *
     * @return self
     */
    public function setInfos($infos)
    {
        $this->infos = $infos;

        return $this;
    }

    /**
     * get plv
     *
     * @return \Datetime
     */
    public function getPlv()
    {
        return $this->plv;
    }

    /**
     * set plv
     *
     * @param \Datetime $plv
     *
     * @return self
     */
    public function setPlv($plv)
    {
        $this->plv = $plv;

        return $this;
    }



}