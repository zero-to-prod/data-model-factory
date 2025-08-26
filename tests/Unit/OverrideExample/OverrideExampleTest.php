<?php

namespace Tests\Unit\OverrideExample;

use Tests\TestCase;

class OverrideExampleTest extends TestCase
{
    /**
     * @test
     *
     * @see DataModelFactory
     */
    public function from(): void
    {
        $User = UserFactory::factory()->make();

        self::assertEquals('John', $User->fist_name);
        self::assertEquals('Doe', $User->last_name);
    }
}