# `Zerotoprod\DataModelFactory`

[![Repo](https://img.shields.io/badge/github-gray?logo=github)](https://github.com/zero-to-prod/data-model-factory)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/zero-to-prod/data-model-factory.svg)](https://packagist.org/packages/zero-to-prod/data-model-factory)
![test](https://github.com/zero-to-prod/data-model-factory/actions/workflows/phpunit.yml/badge.svg)
![Downloads](https://img.shields.io/packagist/dt/zero-to-prod/data-model-factory.svg?style=flat-square&#41;]&#40;https://packagist.org/packages/zero-to-prod/data-model-factory&#41)

## Installation

Install the package via Composer:

```bash
composer require zero-to-prod/data-model-factory
```

For easier model instantiation, we recommend adding the [DataModel](https://github.com/zero-to-prod/data-model) trait.

```bash
composer require zero-to-prod/data-model
```

## Usage

1. Include the Factory trait in your factory class.
2. Set the `$model` property to the class you want to instantiate.
3. Implement a `definition()` method that returns an array of default values.

```php
class User
{
    use \Zerotoprod\DataModelFactory\DataModel;

    public $first_name;
    public $last_name;

    public static function factory(array $states): UserFactory
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

echo $User->first_name; // 'Jane'
echo $User->last_name;  // 'Doe'
```

### Overriding Class Instantiation

To customize instantiation, override the `instantiate()` method in your factory and call it within `make()`.