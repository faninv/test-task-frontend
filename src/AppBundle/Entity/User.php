<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;
use \DateTime;

/**
 * User.
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\UserRepository")
 * @Serializer\ExclusionPolicy("all")
 */
class User
{
    const GENDER_MALE = 'male';
    const GENDER_FEMALE = 'female';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @Serializer\Expose()
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="id_token", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    protected $idToken;

    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     * @Serializer\Expose()
     */
    protected $userName;

    /**
     * @var string
     *
     * @ORM\Column(name="user_email", type="string", length=255, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Email()
     * @Serializer\Expose()
     */
    protected $userEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     * @Assert\NotBlank(groups={"password"})
     * @Serializer\Expose()
     */
    protected $password;

    /**
     * @var string
     *
     * @ORM\Column(name="site_url", type="string", length=255, nullable=true)
     * @Assert\Url()
     * @Serializer\Expose()
     */
    protected $siteUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="user_phone", type="string", length=255, nullable=true)
     * @Serializer\Expose()
     */
    protected $userPhone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_birthday", type="date", nullable=true)
     * @Serializer\Expose()
     */
    protected $userBirthday;

    /**
     * @var string
     *
     * @ORM\Column(name="user_gender", type="string", length=255, nullable=true)
     * @Serializer\Expose()
     */
    protected $userGender = self::GENDER_MALE;

    /**
     * @var string
     *
     * @ORM\Column(name="user_about", type="text", nullable=true)
     * @Serializer\Expose()
     */
    protected $userAbout;

    /**
     * @var string
     *
     * @ORM\Column(name="user_skill", type="integer", nullable=true)
     * @Serializer\Expose()
     */
    protected $userSkill;

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
     * Set userName
     *
     * @param string $userName
     *
     * @return User
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get userName
     *
     * @return string
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set userEmail
     *
     * @param string $userEmail
     *
     * @return User
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    /**
     * Get userEmail
     *
     * @return string
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * Set password
     *
     * @param string $password
     *
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
     * Set siteUrl
     *
     * @param string $siteUrl
     *
     * @return User
     */
    public function setSiteUrl($siteUrl)
    {
        $this->siteUrl = $siteUrl;

        return $this;
    }

    /**
     * Get siteUrl
     *
     * @return string
     */
    public function getSiteUrl()
    {
        return $this->siteUrl;
    }

    /**
     * Set userPhone
     *
     * @param string $userPhone
     *
     * @return User
     */
    public function setUserPhone($userPhone)
    {
        $this->userPhone = $userPhone;

        return $this;
    }

    /**
     * Get userPhone
     *
     * @return string
     */
    public function getUserPhone()
    {
        return $this->userPhone;
    }

    /**
     * Set userBirthday
     *
     * @param \DateTime $userBirthday
     *
     * @return User
     */
    public function setUserBirthday($userBirthday)
    {
        $this->userBirthday = new DateTime($userBirthday);
        return $this;
    }

    /**
     * Get userBirthday
     *
     * @return \DateTime
     */
    public function getUserBirthday()
    {
        return $this->userBirthday;
    }

    /**
     * Get getUserBirthdayInputFormatted
     *
     *  @return string Birthday Formatted for input type date
     */
    public function getUserBirthdayInputFormatted(){
        return $this->userBirthday->format('Y-m-d');
    }

    /**
     * Set userGender
     *
     * @param string $userGender
     *
     * @return User
     */
    public function setUserGender($userGender)
    {
        $this->userGender = $userGender;

        return $this;
    }

    /**
     * Get userGender
     *
     * @return string
     */
    public function getUserGender()
    {
        return $this->userGender;
    }

    /**
     * Set userAbout
     *
     * @param string $userAbout
     *
     * @return User
     */
    public function setUserAbout($userAbout)
    {
        $this->userAbout = $userAbout;

        return $this;
    }

    /**
     * Get userAbout
     *
     * @return string
     */
    public function getUserAbout()
    {
        return $this->userAbout;
    }

    /**
     * Set userSkill
     *
     * @param integer $userSkill
     *
     * @return User
     */
    public function setUserSkill($userSkill)
    {
        $this->userSkill = $userSkill;

        return $this;
    }

    /**
     * Get userSkill
     *
     * @return integer
     */
    public function getUserSkill()
    {
        return $this->userSkill;
    }

    /**
     * Set idToken
     *
     * @param string $idToken
     *
     * @return User
     */
    public function setIdToken($idToken)
    {
        $this->idToken = $idToken;

        return $this;
    }

    /**
     * Get idToken
     *
     * @return string
     */
    public function getIdToken()
    {
        return $this->idToken;
    }
}
