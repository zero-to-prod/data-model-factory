<?php

namespace Zerotoprod\DataModelFactory;

trait Factory
{
    private $context;

    public function __construct(array $context = [])
    {
        $this->context = $context;
    }

    private function definition(): array
    {
        return [];
    }

    private function instantiate()
    {
        return $this->model::from(array_merge($this->definition(), $this->context));
    }

    public function make()
    {
        return $this->instantiate();
    }

    private function state(array $state): self
    {
        $this->context = array_merge($this->context, $state);

        return $this;
    }
}