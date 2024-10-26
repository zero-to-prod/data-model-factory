<?php

namespace Tests\Unit\Make;

use Tests\TestCase;

class FactoryTest extends TestCase
{
    /**
     * @test
     *
     * @see Factory
     */
    public function from(): void
    {
        $User = User::factory()->make();

        self::assertEquals('John', $User->first_name);
    }
}