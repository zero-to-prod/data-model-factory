<?php

namespace Tests\Unit\Override;

use DateTime;
use Zerotoprod\DataModelFactory\DataModelFactory;

class UserFactory
{
    use DataModelFactory;

    protected $model = User::class;

    public function setTime(string $value): self
    {
        return $this->state([User::DateTime => $value]);
    }

    private function instantiate()
    {
        return $this->model::from([User::DateTime => new DateTime($this->context[User::DateTime])]);
    }

    public function make(): User
    {
        return $this->instantiate();
    }
}