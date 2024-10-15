<?php

namespace Tests\Unit\Context;

use Tests\TestCase;

class ContextTest extends TestCase
{
    /**
     * @test
     *
     * @see Factory
     */
    public function from(): void
    {
        $User = User::factory([User::last_name => 'Doe'])->make();

        self::assertEquals('John', $User->first_name);
        self::assertEquals('Doe', $User->last_name);
    }
}