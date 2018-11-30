<?php
namespace Model\User;
/**
 * Class User
 */
class User
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $firstname;
    /**
     * @var string
     */
    private $lastname;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $password;
    /**
     * @var bool
     */
    private $role;
    /**
     * @var string
     */
    private $mobile;
    /**
     * @var string
     */
    private $github;
    /**
     * @var string
     */
    private $gitlab;
    /**
     * @var string
     */
    private $linkedin;
    /**
     * @var string
     */
    private $google_drive_maill;
    /**
     *
     */
    private $description;
    /**
     * @var \DateTime
     */
    private $creationDate;
    /**
     * @var string
     */
    private $avatar;
    /**
     * @var string
     */
    private $token;
    /**
     * @var \DateTime
     */
    private $token_expire;
    /**
     * @var boolean
     */
    private $is_confirmed;
    /**
     * @var int
     */
    private $id_language;
    /**
     * @var int
     */
    private $id_promotion;
    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }
    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }
    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;
    }
    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }
    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;
    }
    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
    /**
     * @param string $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }
    /**
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }
    /**
     * @return bool
     */
    public function getRole(): bool
    {
        return $this->role;
    }
    /**
     * @param bool $role
     */
    public function setRole(bool $role)
    {
        $this->role = $role;
    }
    /**
     * @return string
     */
    public function getMobile(): ?string
    {
        return $this->mobile;
    }
    /**
     * @param string $mobile
     */
    public function setMobile(string $mobile)
    {
        $this->mobile = $mobile;
    }
    /**
     * @return string
     */
    public function getGithub(): ?string
    {
        return $this->github;
    }
    /**
     * @param string $github
     */
    public function setGithub(string $github)
    {
        $this->github = $github;
    }
    /**
     * @return string
     */
    public function getGitlab(): ?string
    {
        return $this->gitlab;
    }
    /**
     * @param string $gitlab
     */
    public function setGitlab(string $gitlab)
    {
        $this->gitlab = $gitlab;
    }
    /**
     * @return string
     */
    public function getLinkedin(): ?string
    {
        return $this->linkedin;
    }
    /**
     * @param string $linkedin
     */
    public function setLinkedin(string $linkedin)
    {
        $this->linkedin = $linkedin;
    }
    /**
     * @return string
     */
    public function getGoogleDriveMail(): ?string
    {
        return $this->google_drive_mail;
    }
    /**
     * @param string $google_drive_mail
     */
    public function setGoogleDriveMail(string $google_drive_mail)
    {
        $this->google_drive_mail = $google_drive_mail;
    }
    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    /**
     * @return \DateTime
     */
    public function getCreationDate(): \DateTime
    {
        return $this->creationDate;
    }
    /**
     * @param \DateTime $creationDate
     */
    public function setCreationDate(\DateTime $creationDate)
    {
        $this->creationDate = $creationDate;
    }
    /**
     * @return string
     */
    public function getAvatar(): ?string
    {
        return $this->avatar;
    }
    /**
     * @param string $avatar
     */
    public function setAvatar(string $avatar)
    {
        $this->avatar = $avatar;
    }
    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }
    /**
     * @param string $token
     */
    public function setToken(string $token)
    {
        $this->token = $token;
    }
    /**
     * @return \DateTime
     */
    public function getTokenExpire(): \DateTime
    {
        return $this->token_expire;
    }
    /**
     * @param \DateTime $token_expire
     */
    public function setTokenExpire(\DateTime $token_expire)
    {
        $this->token_expire = $token_expire;
    }
    /**
     * @return bool
     */
    public function getIsConfirmed(): ?bool
    {
        return $this->is_confirmed;
    }
    /**
     * @param bool $is_confirmed
     */
    public function setIsConfirmed(bool $is_confirmed)
    {
        $this->is_confirmed = $is_confirmed;
    }
    /**
     * @return int
     */
    public function getIdLanguage(): int
    {
        return $this->id_language;
    }
    /**
     * @param int $id_language
     */
    public function setIdLanguage(int $id_language)
    {
        $this->id_language = $id_language;
    }
    /**
     * @return int
     */
    public function getIdPromotion(): int
    {
        return $this->id_promotion;
    }
    /**
     * @param int $id_promotion
     */
    public function setIdPromotion(int $id_promotion)
    {
        $this->id_promotion = $id_promotion;
    }
}