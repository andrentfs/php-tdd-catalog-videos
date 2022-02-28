<?php 

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MethodsMagicsTrait;
use Core\Domain\Validation\DomainValidation;
use Core\Domain\ValueObject\Uuid;

class Category
{
    use MethodsMagicsTrait;

    public function __construct(
        protected Uuid|string $id = '',
        protected string $name = '',
        protected string $description = '',
        protected bool $isActive = true,
    ){
        $this->id = $this->id ? new Uuid($this->id): Uuid::random();

        $this->validate();
    }

    public function activate()
    {
        $this->isActive = true;
    }

    public function disable()
    {
        $this->isActive = false;
    }

    public function update (string $name, string $description = '')
    {
        $this->name = $name;
        $this->description = $description;

        $this->validate();
    }

    public function validate()
    {
        DomainValidation::strMaxLength($this->name);
        DomainValidation::strMinLength($this->name);
        DomainValidation::strCanNullAndMaxLength($this->description, 255);
    }
}