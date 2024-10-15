<?php

namespace Tests\Unit\Override;

use Tests\Unit\DataModel;

class User
{
    use DataModel;

    public const DateTime = 'DateTime';
    public $DateTime;

    public static function factory(array $states = []): UserFactory
    {
        return new UserFactory($states);
    }
}