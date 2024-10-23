# `Zerotoprod\DataModelFactory`

[![Repo](https://img.shields.io/badge/github-gray?logo=github)](https://github.com/zero-to-prod/data-model-factory)
[![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/zero-to-prod/data-model-factory/phpunit.yml?label=tests)](https://github.com/zero-to-prod/data-model-factory/actions)
[![Packagist Downloads](https://img.shields.io/packagist/dt/zero-to-prod/data-model-factory?color=blue)](https://packagist.org/packages/zero-to-prod/data-model-factory/stats)
[![Packagist Version](https://img.shields.io/packagist/v/zero-to-prod/data-model-factory?color=f28d1a)](https://packagist.org/packages/zero-to-prod/data-model-factory)
[![GitHub repo size](https://img.shields.io/github/repo-size/zero-to-prod/data-model-factory)](https://github.com/zero-to-prod/data-model-factory)
[![License](https://img.shields.io/packagist/l/zero-to-prod/data-model-factory?color=red)](https://github.com/zero-to-prod/data-model-factory/blob/main/LICENSE.md)

## Installation

Install the package via Composer:

```bash
composer require zero-to-prod/data-model-factory
```

For easier model instantiation, we recommend adding the [DataModel](https://github.com/zero-to-prod/data-model) trait.

### Additional Packages

- [DataModel](https://github.com/zero-to-prod/data-model): Transform data into a class.
- [DataModelHelper](https://github.com/zero-to-prod/data-model-helper): Helpers for a `DataModel`.
- [Transformable](https://github.com/zero-to-prod/transformable): Transform a `DataModel` into different types.

## Usage

This example makes use of the [DataModel](https://github.com/zero-to-prod/data-model) trait to instantiate the `User` class.

You can install the DataModel package like this:

```bash
composer require zero-to-prod/data-model
```

If you don't want to use this trait, you can [customize the class instantiation](#custom-class-instantiation) this way.

1. Include the Factory trait in your factory class.
2. Set the `$model` property to the class you want to instantiate.
3. Implement a `definition()` method that returns an array of default values.

```php
class User
{
    use \Zerotoprod\DataModelFactory\DataModel;

    public $first_name;
    public $last_name;
    
    public static function factory(array $states = []): UserFactory
    {
        return new UserFactory($states);
    }
}

class UserFactory
{
    use \Zerotoprod\DataModelFactory\Factory;

    protected $model = User::class;

    protected function definition(): array
    {
        return [
            'first_name' => 'John',
            'last_name' => 'N/A'
        ];
    }
    
    public function setFirstName(string $value): self
    {
        return $this->state(['first_name' => $value]);
    }
    
    public function setLastName(): self
    {
        return $this->state(function ($context) {
            return ['first_name' => $context['last_name']];
        });
    }
    
    public function make(): User
    {
        return $this->instantiate();
    }
}

$User = User::factory([User::last_name => 'Doe'])
            ->setFirstName('Jane')
            ->make();
// UserFactory::factory([User::last_name => 'Doe'])->make(); Also works

echo $User->first_name; // 'Jane'
echo $User->last_name;  // 'Doe'
```

### Custom Class Instantiation

To customize instantiation, override the `make()` method.

```php
class User
{
    public function __construct(public string $fist_name, public string $last_name)
    {
    }
}

class UserFactory
{
    use \Zerotoprod\DataModelFactory\Factory;

    private function definition(): array
    {
        return [
            'first_name' => 'John',
            'last_name' => 'Doe',
        ];
    }

    private function make(): User
    {
        return new User($this->context['first_name'], $this->context['last_name']);
    }
}

$User = UserFactory::factory()->make();

echo $User->first_name; // 'Jane'
echo $User->last_name;  // 'Doe'
```