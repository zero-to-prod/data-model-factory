<?php

namespace Tests\Unit\Make;

use Zerotoprod\DataModelFactory\Factory;

class UserFactory
{
    use Factory;

    protected $model = User::class;

    protected function definition(): array
    {
        return [
            User::first_name => 'John'
        ];
    }
}