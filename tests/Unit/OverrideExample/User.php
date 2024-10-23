<?php

namespace Tests\Unit\OverrideExample;

class User
{
    public $fist_name;
    public $last_name;

    public function __construct(string $fist_name, string $last_name)
    {
        $this->last_name = $last_name;
        $this->fist_name = $fist_name;
    }
}