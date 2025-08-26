<?php

namespace Tests\Unit\Method;

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
        $User = User::factory()
            ->setFirstName('Jim')
            ->make();

        self::assertEquals('Jim', $User->first_name);
        self::assertEquals('N/A', $User->last_name);
    }

    /**
     * @test
     *
     * @see DataModelFactory
     */
    public function nested_element(): void
    {
        $User = User::factory()
            ->setAddress('bogus')
            ->make();

        self::assertEquals('bogus', $User->address['street']);
    }

    /**
     * @test
     *
     * @see DataModelFactory
     */
    public function nested_array(): void
    {
        $User = User::factory()
            ->setShippingAddress(['bogus' => 'Bogus'])
            ->make();

        self::assertEquals(['bogus' => 'Bogus'], $User->shipping_address);
    }
}