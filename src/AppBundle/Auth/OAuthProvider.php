<?php
namespace AppBundle\Auth;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use HWI\Bundle\OAuthBundle\Security\Core\User\OAuthUserProvider;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class OAuthProvider extends OAuthUserProvider
{
    protected $entity_manager;
    protected $container;

    public function __construct(EntityManager $entity_manager, Container $container)
    {
        $this->entity_manager = $entity_manager;
        $this->container = $container;
    }

    public function loadUserByUsername($username)
    {
        try {
            $user = $this->entity_manager->getRepository('AppBundle:User')->createQueryBuilder('u')
                ->where('u.facebook = :facebook')
                ->setParameter('facebook', $username)
                ->getQuery()
                ->getSingleResult();
        } catch (\Exception $e) {
            throw new UsernameNotFoundException();
        }

        /*$token = new UsernamePasswordToken($user, null, 'secured_area', $user->getRoles());
        $this->container->get('security.context')->setToken($token);

        $request = $this->container->get('request');
        $event = new InteractiveLoginEvent($request, $token);
        $this->container->get('event_dispatcher')->dispatch('security.interactive_login', $event);*/

        return $user;
    }

    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $data = $response->getResponse();
        $facebook = $data['id'];
        $username = $data['name'];
        $email = $data['email'];

        try {
            $user = $this->entity_manager->getRepository('AppBundle:User')->createQueryBuilder('u')
                ->where('u.facebook = :facebook')
                ->setParameter('facebook', $facebook)
                ->getQuery()
                ->getSingleResult();
        } catch (\Exception $e) {
            $user = new User();
            $user->setFacebook($facebook);
            $user->setEmail($email);
            $user->setFullName($username);

            $this->entity_manager->persist($user);
            $this->entity_manager->flush();
        }

        return $this->loadUserByUsername($user->getFacebook());
    }

    public function supportsClass($class)
    {
        return $class === 'AppBundle\Entity\User';
    }
}
