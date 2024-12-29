<?php

namespace Tests\Unit\Make;

use Tests\Unit\DataModel;

class User
{
    use DataModel;

    public const first_name = 'first_name';
    public $first_name;

    public static function factory(array $context = []): UserFactory
    {
        return new UserFactory($context);
    }
}