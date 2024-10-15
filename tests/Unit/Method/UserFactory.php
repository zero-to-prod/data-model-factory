<?php

namespace Tests\Unit\Method;

use Zerotoprod\DataModelFactory\Factory;

class UserFactory
{
    use Factory;

    protected $model = User::class;

    protected function definition(): array
    {
        return [
            User::first_name => 'John',
            User::last_name => 'N/A'
        ];
    }

    public function setFirstName(string $value): self
    {
        return $this->state([User::first_name => $value]);
    }

    public function make(): User
    {
        return $this->instantiate();
    }
}