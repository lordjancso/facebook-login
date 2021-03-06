<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UserRepository")
 * @UniqueEntity("email")
 * @UniqueEntity("facebook")
 */
class User implements UserInterface
{
    use TimestampableEntity;

    const ROLE_USER = 'ROLE_USER';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Email()
     * @ORM\Column(name="email", type="string", unique=true, length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="full_name", type="string", length=255, nullable=true)
     */
    private $fullName;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="facebook", type="string", length=255, unique=true, nullable=true)
     */
    private $facebook;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_login_datetime", type="datetime", nullable=true)
     */
    private $lastLoginDatetime;

    /**
     * @var string
     *
     * @ORM\Column(name="last_login_client_ip", type="string", length=255, nullable=true)
     */
    private $lastLoginClientIp;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set fullName
     *
     * @param string $fullName
     * @return User
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     * @return User
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set lastLoginDatetime
     *
     * @param \DateTime $lastLoginDatetime
     * @return User
     */
    public function setLastLoginDatetime($lastLoginDatetime)
    {
        $this->lastLoginDatetime = $lastLoginDatetime;

        return $this;
    }

    /**
     * Get lastLoginDatetime
     *
     * @return \DateTime
     */
    public function getLastLoginDatetime()
    {
        return $this->lastLoginDatetime;
    }

    /**
     * Set lastLoginClientIp
     *
     * @param string $lastLoginClientIp
     * @return User
     */
    public function setLastLoginClientIp($lastLoginClientIp)
    {
        $this->lastLoginClientIp = $lastLoginClientIp;

        return $this;
    }

    /**
     * Get lastLoginClientIp
     *
     * @return string
     */
    public function getLastLoginClientIp()
    {
        return $this->lastLoginClientIp;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles()
    {
        return array(self::ROLE_USER);
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials()
    {
        //
    }
}
