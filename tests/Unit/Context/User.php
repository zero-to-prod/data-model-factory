<?php

namespace Tests\Unit\Context;

use Tests\Unit\DataModel;

class User
{
    use DataModel;

    public const first_name = 'first_name';
    public const last_name = 'last_name';
    public $first_name;
    public $last_name;

    public static function factory(array $context): UserFactory
    {
        return new UserFactory($context);
    }
}