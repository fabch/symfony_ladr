<?php
namespace LADR\SmsBundle\Sms;

use LADR\SmsBundle\Entity\SmsEntity;

/**
 * @author Fabien Chartrain <fabien.chartrain@gmail.com>
 * @date   : 06/03/17
 * @time   : 12:54
 */
class SmsFactory
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $type;

    /**
     * @param $config
     */
    public function __construct($key, $type)
    {
        $this->key = $key;
        $this->type = $type;
    }

    /**
     * Generate a new FileSource with a relative path.
     *
     * @param \SplFileInfo $file
     * @param null|int     $line
     * @param null|int     $column
     *
     * @return SmsEntity
     */
    public function create()
    {
        return new SmsEntity();
    }

}