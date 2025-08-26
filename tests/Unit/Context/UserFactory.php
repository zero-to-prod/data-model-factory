<?php

namespace Tests\Unit\Context;

use Zerotoprod\DataModelFactory\DataModelFactory;

class UserFactory
{
    use DataModelFactory;

    protected $model = User::class;

    protected function definition(): array
    {
        return [
            User::first_name => 'John',
            User::last_name => 'N/A'
        ];
    }

    public function make(): User
    {
        return $this->instantiate();
    }
}