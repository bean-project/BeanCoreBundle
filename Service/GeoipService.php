<?php
namespace Bean\Bundle\CoreBundle\Service;

class GeoipService
{
    private $container;

    function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * @var string
     */
    protected $slugifier;


    /**
     * @param string $address
     */
    public function getCountryCode($address = null)
    {
        if (empty($address)) {
            $address = $this->container->get('request_stack')->getCurrentRequest()->getClientIp();
//			$address = '14.169.158.182'; // sample VN IP
//            $address = '180.255.240.43'; // sample SG IP
        }
        return geoip_country_code_by_name($address);
    }
}