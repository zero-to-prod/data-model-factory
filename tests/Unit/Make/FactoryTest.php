<?php

namespace Tests\Unit\Make;

use Tests\TestCase;

class FactoryTest extends TestCase
{
    /**
     * @test
     *
     * @see DataModelFactory
     */
    public function from(): void
    {
        $User = User::factory()->make();

        self::assertEquals('John', $User->first_name);
    }

    /**
     * @test
     *
     * @see DataModelFactory
     */
    public function make(): void
    {
        $User = User::factory()->make([User::first_name => 'Jane']);

        self::assertEquals('Jane', $User->first_name);
    }
}