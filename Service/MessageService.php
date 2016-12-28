<?php

namespace Bean\Bundle\CoreBundle\Service;


use Symfony\Component\DependencyInjection\ContainerInterface;

class MessageService
{
    /**
     * @var ContainerInterface
     */
    private $container;

    function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param mixed $msg
     * @param bool $flushed
     * called from InvitationAdmin
     */
    public function send($msg, $flushed = true)
    {
        $mailer = $this->container->get('mailer');
        $mailer->send($msg);

        if ($flushed === true) {
            $spool = $mailer->getTransport()->getSpool();
            $transport = $this->container->get('swiftmailer.transport.real');
            if ($spool and $transport) {
                $spool->flushQueue($transport);
            }
        }
    }

}