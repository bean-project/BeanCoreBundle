<?php
namespace Bean\Bundle\CoreBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;

class DateTimeService
{
    /**
     * @var ContainerInterface $container ;
     */
    private $container;

    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param string $format
     * @param \DateTime $time
     * @param \DateTimeZone $timezone
     */
    public function format($format, $time = null, $timezone = null)
    {
        if (empty($time)) {
            $time = new \DateTime('now', $timezone);
        }
        return $time->format($format);
    }

    /**
     * @param string $address
     */
    public function getTimezone($address = null)
    {
        if (empty($address)) {
            $request = $this->container->get('request_stack')->getcurrentrequest();
            $session = $request->getSession();
            $timezone = $session->get('bean_timezone');
			if (empty($timezone)) {
                return date_default_timezone_get();
            } else {
                return $timezone;
            }
		}
        return geoip_time_zone_by_country_and_region(geoip_country_code_by_name($address));
    }
}