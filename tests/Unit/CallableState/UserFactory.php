<?php

namespace Tests\Unit\CallableState;

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

    public function setLastName(): self
    {
        return $this->state(function ($context) {
            return [User::first_name => $context['last_name']];
        });
    }

    public function make(): User
    {
        return $this->instantiate();
    }

    public static function factory(array $states = []): UserFactory
    {
        return new UserFactory($states);
    }
}