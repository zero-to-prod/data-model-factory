<?php

namespace Tests\Unit;

trait DataModel
{
    public static function from(array $context): self
    {
        $self = new static();
        foreach ($context as $key => $value) {
            $self->{$key} = $value;
        }

        return $self;
    }
}