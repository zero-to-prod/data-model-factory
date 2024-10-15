<?php

namespace Tests\Unit\Factory;

use Tests\Unit\DataModel;

class User
{
    use DataModel;

    public const first_name = 'first_name';
    public const last_name = 'last_name';
    public $first_name;
    public $last_name;

    public static function factory(array $states = []): UserFactory
    {
        return new UserFactory($states);
    }
}