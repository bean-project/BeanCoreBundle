<?php
namespace Bean\Bundle\CoreBundle\Service;

use Cocur\Slugify\Slugify;

class StringService
{
    /**
     * @var string
     */
    protected $slugifier;
    /**
     * @var \DateTime
     */
    protected $time;

    function __construct()
    {
        $this->slugifier = new Slugify();
        $this->time = new \DateTime();
    }

    /**
     * @param \DateTime $time
     */
    public function formatDateTime($format, $time = null, $timezone = null)
    {
        if (empty($time)) {
            $time = $this->time;
        }
        return $time->format($format);
    }

    /**
     * @param string $string
     */
    public function slugify($string)
    {
        return $this->slugifier->slugify($string);
    }

    public function generateFriendlyCode($prefix = null)
    {
        if (empty($prefix)) {
            $prefix = base_convert(rand(100000, 999999), 10, 32);
        }
        $code = $prefix . '-' . base_convert(rand(10000, 99999), 10, 32);
        return strtoupper($code);
    }
}