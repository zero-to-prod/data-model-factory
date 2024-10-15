<?php

namespace Tests\Unit\CallableState;

use Tests\TestCase;

class CallableStateFactory extends TestCase
{
    /**
     * @test
     *
     * @see Factory
     */
    public function from(): void
    {
        $User = UserFactory::factory()
            ->setLastName()
            ->make();

        self::assertEquals('John', $User->first_name);
        self::assertEquals('John', $User->last_name);
    }
}