<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Shared\Domain\Security\AuthUserInterface;
use App\Shared\Domain\Service\UlidService;
use App\Users\Domain\Service\UserPasswordHasherInterface;

class Employee
{
    private int $id;
    private string $name;
    private string $parentName;

    public function __construct()
    {
    }

    public function getEmployeeId(): int
    {
        return $this->id;
    }

    public function getEmployeeName(): string
    {
        return $this->name;
    }

    public function getEmployeeParentName(): string
    {
        return $this->parentName;
    }

    public function setEmployeeId($id): static
    {
        $this->id = $id;

        return $this;
    }

    public function setEmployeeName($name): static
    {
        $this->name = $name;

        return $this;
    }

    public function setEmployeeParentName($parentName): static
    {
        $this->parentName = $parentName;

        return $this;
    }
}
