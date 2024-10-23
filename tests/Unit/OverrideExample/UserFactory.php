<?php

namespace Tests\Unit\OverrideExample;

use Zerotoprod\DataModelFactory\Factory;

class UserFactory
{
    use Factory;

    private function definition(): array
    {
        return [
            'first_name' => 'John',
            'last_name' => 'Doe',
        ];
    }

    public function make(): User
    {
        return new User($this->context['first_name'], $this->context['last_name']);
    }
}