<?php

namespace AppBundle\Event\Listener;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class LoginListener
{
    private $entity_manager;
    private $container;

    public function __construct(EntityManager $entity_manager, Container $container)
    {
        $this->entity_manager = $entity_manager;
        $this->container = $container;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $client_ip = $this->container->get('request')->getClientIp();

        /** @var User $user */
        $user = $event->getAuthenticationToken()->getUser();

        $user->setLastLoginDatetime(new \DateTime());
        $user->setLastLoginClientIp($client_ip);

        $this->entity_manager->flush($user);
    }
}
