<?php

namespace Tests\Unit\Make;

use Zerotoprod\DataModelFactory\DataModelFactory;

class UserFactory
{
    use DataModelFactory;

    protected $model = User::class;

    protected function definition(): array
    {
        return [
            User::first_name => 'John'
        ];
    }
}