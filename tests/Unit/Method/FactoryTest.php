<?php

namespace Tests\Unit\Method;

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
        $User = User::factory()
            ->setFirstName('Jim')
            ->make();

        self::assertEquals('Jim', $User->first_name);
        self::assertEquals('N/A', $User->last_name);
    }
}