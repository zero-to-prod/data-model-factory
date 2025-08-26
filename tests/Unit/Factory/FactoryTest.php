<?php

namespace Tests\Unit\Factory;

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
        $User = UserFactory::factory()->make();

        self::assertEquals('John', $User->first_name);
        self::assertEquals('N/A', $User->last_name);
    }
}