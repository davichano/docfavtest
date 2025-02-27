<?php

namespace Domain\User\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Domain\User\ValueObject\Email;
use Domain\User\ValueObject\Name;
use Domain\User\ValueObject\Password;
use Domain\User\ValueObject\UserId;

#[ORM\Entity]
#[ORM\Table(name: "users")]
class User
{
    #[ORM\Id, ORM\Column(type: "string")]
    private UserId $id;
    #[ORM\Column(type: "string", length: 50)]
    private Name $name;
    #[ORM\Column(type: "string", unique: true)]
    private Email $email;
    #[ORM\Column(type: "string")]
    private Password $password;
    #[ORM\Column(type: "datetime_immutable")]
    private DateTimeImmutable $createdAt;

    /**
     * @param UserId $id
     * @param Name $name
     * @param Email $email
     * @param Password $password
     */
    public function __construct(UserId $id, Name $name, Email $email, Password $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->createdAt = new DateTimeImmutable();
    }

    public function getId(): UserId
    {
        return $this->id;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function getPassword(): Password
    {
        return $this->password;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

}