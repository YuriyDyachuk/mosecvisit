<?php

declare(strict_types=1);

namespace App\VO;

class UserVO
{
    private ?int    $role;
    private ?string $name;
    private ?string $email;
    private ?string $phone;
    private ?string $login;
    private ?string $nameCompany;

    public function __construct(
        $role,
        $name,
        $email,
        $phone,
        $login = null,
        $nameCompany
    ){
        $this->role = $role;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->login = $login;
        $this->nameCompany = $nameCompany;
    }

    /**
     * @return int|null
     */
    public function getRole(): ?int
    {
        return $this->role;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return string|null
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * @return string|null
     */
    public function getNameCompany(): ?string
    {
        return $this->nameCompany;
    }
}
