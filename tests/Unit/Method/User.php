<?php

namespace Tests\Unit\Method;

use Tests\Unit\DataModel;

class User
{
    use DataModel;

    public const first_name = 'first_name';
    public const last_name = 'last_name';
    public const address = 'address';
    public const shipping_address = 'shipping_address';
    public $first_name;
    public $last_name;
    public $address;
    public $shipping_address;

    public static function factory(array $context = []): UserFactory
    {
        return new UserFactory($context);
    }
}