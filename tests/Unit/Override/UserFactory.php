<?php

namespace Tests\Unit\Override;

use DateTime;
use Zerotoprod\DataModelFactory\Factory;

class UserFactory
{
    use Factory;

    protected $model = User::class;

    public function setTime(string $value): self
    {
        return $this->state([User::DateTime => $value]);
    }

    private function instantiate()
    {
        return $this->model::from([User::DateTime => new DateTime($this->context['time'])]);
    }

    public function make(): User
    {
        return $this->instantiate();
    }
}