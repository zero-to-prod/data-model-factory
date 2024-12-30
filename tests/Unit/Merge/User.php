<?php

namespace Tests\Unit\Merge;

use Tests\Unit\DataModel;

class User
{
    use DataModel;

    public const first_name = 'first_name';
    public const last_name = 'last_name';
    public const surname = 'surname';
    public const address = 'address';
    public $first_name;
    public $last_name;
    public $surname;
    public $address;
}