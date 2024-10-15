<?php

namespace Tests\Unit\Override;

use DateTime;
use Tests\TestCase;

class OverrideTest extends TestCase
{
    /**
     * @test
     *
     * @see Factory
     */
    public function from(): void
    {
        $User = User::factory()
            ->setTime('2015-10-04 17:24:43.000000')
            ->make();

        self::assertInstanceOf(DateTime::class, $User->DateTime);
    }
}