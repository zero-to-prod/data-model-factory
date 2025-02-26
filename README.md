# Zerotoprod\DataModelFactory

![](art/logo.png)

[![Repo](https://img.shields.io/badge/github-gray?logo=github)](https://github.com/zero-to-prod/data-model-factory)
[![tests](https://img.shields.io/github/actions/workflow/status/zero-to-prod/data-model-factory/test.yml?label=test)](https://github.com/zero-to-prod/data-model-factory/actions)
[![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/zero-to-prod/data-model-factory/backwards_compatibility.yml?label=backwards_compatibility)](https://github.com/zero-to-prod/data-model-factory/actions)
[![Packagist Downloads](https://img.shields.io/packagist/dt/zero-to-prod/data-model-factory?color=blue)](https://packagist.org/packages/zero-to-prod/data-model-factory/stats)
[![php](https://img.shields.io/packagist/php-v/zero-to-prod/data-model-factory.svg?color=purple)](https://packagist.org/packages/zero-to-prod/data-model-factory/stats)
[![Packagist Version](https://img.shields.io/packagist/v/zero-to-prod/data-model-factory?color=f28d1a)](https://packagist.org/packages/zero-to-prod/data-model-factory)
[![License](https://img.shields.io/packagist/l/zero-to-prod/data-model-factory?color=pink)](https://github.com/zero-to-prod/data-model-factory/blob/main/LICENSE.md)
[![wakatime](https://wakatime.com/badge/github/zero-to-prod/data-model-factory.svg)](https://wakatime.com/badge/github/zero-to-prod/data-model-factory)
[![Hits-of-Code](https://hitsofcode.com/github/zero-to-prod/data-model-factory?branch=main)](https://hitsofcode.com/github/zero-to-prod/data-model-factory/view?branch=main)

## Contents

- [Introduction](#introduction)
- [Requirements](#requirements)
- [Installation](#installation)
    - [Additional Packages](#additional-packages)
- [Usage](#usage)
    - [Custom Class Instantiation](#custom-class-instantiation)
    - [The `set()` Method](#the-set-method)
    - [The `merge()` Method](#the-merge-method)
    - [The `context()` Method](#the-context-method)
- [Local Development](./LOCAL_DEVELOPMENT.md)
- [Contributing](#contributing)

## Introduction

This package is a fresh take on how to set the state of your DTOs in a simple and delightful way.

The API is takes some hints from Laravel's Eloquent [Factories](https://laravel.com/docs/11.x/eloquent-factories), but adds some niceties such as
setting state via dot syntax and using the [set()](#the-set-method) helper method on the fly.

This package does not require any other dependencies, allowing you to make a factory for anything.

The examples use the [DataModel](https://github.com/zero-to-prod/data-model) trait, making easier to build your DTOs, but it is not required.

## Requirements

- PHP 7.1 or higher.

## Installation

Install the package via Composer:

```bash
composer require zero-to-prod/data-model-factory
```

This will add the package to your project’s dependencies and create an autoloader entry for it.

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

4. NOTE: The `$this->state()` method accepts dot syntax, arrays, or a callback.

```php
class User
{
    use \Zerotoprod\DataModelFactory\DataModel;

    public $first_name;
    public $last_name;
    public $address;
    
    public static function factory(array $context = []): UserFactory
    {
        return new UserFactory($context);
    }
}

class UserFactory
{
    use \Zerotoprod\DataModelFactory\Factory;

    /* This is the class to be instantiated with the make() method */
    protected $model = User::class;

    protected function definition(): array
    {
        return [
            'first_name' => 'John',
            'last_name' => 'N/A',
            'address' => [
                'street' => 'Memory Lane'
            ]
        ];
    }
    
    public function setStreet(string $value): self
    {
        /** Dot Syntax */
        return $this->state('address.street', $value);
    }
    
    public function setFirstName(string $value): self
    {
        /** Array Syntax */
        return $this->state(['first_name' => $value]);
    }
    
    public function setLastName(): self
    {
        /** Closure Syntax */
        return $this->state(function ($context) {
            return ['first_name' => $context['last_name']];
        });
    }
    
    /* Optionally implement for better static analysis */
    public function make(): User
    {
        return $this->instantiate();
    }
}

$User = UserFactory::factory([User::last_name => 'Doe'])
            ->setFirstName('Jane')
            ->make();
            
User::factory([User::last_name => 'Doe'])->make(); // Also works for this example

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

### The `set()` Method

You can use the `set()` helper method to fluently modify the state of your model in a convenient way.

This is a great way to modify a model without having to implement a method in the factory.

```php
$User = User::factory()
            ->set('first_name', 'John')
            ->set(['last_name' => 'Doe'])
            ->set(function ($context) {
                return ['surname' => $context['last_name']];
            })
            ->set('address.postal_code', '46789') // dot syntax for nested values 
            ->make();

echo $User->first_name;             // John
echo $User->last_name;              // Doe
echo $User->surname;                // Doe
echo $User->address->postal_code;   // 46789
```

### The `merge()` Method

Sometimes it is useful to merge new values into the current context of the factory.

Use the `merge()` method to merge any new values and update the factory context.

```php
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
}

$User = UserFactory::factory()
    ->merge(['first_name' => 'Jane'])
    ->make();

echo $User->first_name; // 'Jane'
echo $User->last_name;  // 'Doe'
```

### The `context()` Method

Use the `context()` method to get the context of the factory.

```php
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
}

$User = UserFactory::factory()->context();

echo $User['first_name']; // 'John'
echo $User['last_name'];  // 'Doe'
```

## Contributing

Contributions, issues, and feature requests are welcome!
Feel free to check the [issues](https://github.com/zero-to-prod/data-model-factory/issues) page if you want to contribute.

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Commit changes (`git commit -m 'Add some feature'`).
4. Push to the branch (`git push origin feature-branch`).
5. Create a new Pull Request.
