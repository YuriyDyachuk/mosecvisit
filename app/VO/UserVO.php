<?php

declare(strict_types=1);

namespace App\VO;

class UserVO
{
    private ?int    $pin;
    private ?int    $role;
    private ?string $name;
    private ?string $email;
    private ?string $phone;
    private ?string $login;

    public function __construct(
        $pin,
        $role,
        $name,
        $email,
        $phone,
        $login = null
    ){
        $this->pin = $pin;
        $this->role = $role;
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->login = $login;
    }

    /**
     * @return int|null
     */
    public function getPin(): ?int
    {
        return $this->pin;
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
}
