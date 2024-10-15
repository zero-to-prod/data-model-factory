<?php

namespace Tests\Unit\CallableState;

use Tests\Unit\DataModel;

class User
{
    use DataModel;

    public const first_name = 'first_name';
    public const last_name = 'last_name';
    public $first_name;
    public $last_name;
}