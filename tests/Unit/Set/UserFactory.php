<?php

namespace Tests\Unit\Set;

use Zerotoprod\DataModelFactory\Factory;

class UserFactory
{
    use Factory;

    protected $model = User::class;

    protected function definition(): array
    {
        return [
            User::first_name => 'John',
            User::last_name => 'N/A',
            User::address => [
                'postal_code' => 'a',
            ],
        ];
    }

    public function make(): User
    {
        return $this->instantiate();
    }
}