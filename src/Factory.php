<?php

namespace Zerotoprod\DataModelFactory;

use Tests\Unit\Override\UserFactory;

/**
 * Factory for Instantiating a Class.
 *
 * ```
 *  class UserFactory
 *  {
 *      use Factory;
 *
 *      protected $model = User::class;
 *
 *      protected function definition(): array
 *      {
 *          return [
 *              'first_name' => 'John'
 *          ];
 *      }
 *
 *      public function setLastName(): self
 *      {
 *          return $this->state(['last_name' => 'Doe']);
 *      }
 *
 *      public function make(): User
 *      {
 *          return $this->instantiate();
 *      }
 *
 *      public static function factory(array $states = []): UserFactory
 *      {
 *          return new UserFactory($states);
 *      }
 *  }
 *
 *  $User = UserFactory::factory(['first_name' => 'Bill'])
 *              ->setLastName('Smith')
 *              ->make();
 *
 * echo $User->last_name; // 'Smith'
 * ```
 *
 * @link https://github.com/zero-to-prod/data-model-factory
 * @see  https://github.com/zero-to-prod/data-model
 */
trait Factory
{
    /**
     * Stores the values for the class.
     *
     * @var array
     * @link https://github.com/zero-to-prod/data-model-factory
     */
    private $context;

    /**
     * Values to instantiate the class.
     *
     * @link https://github.com/zero-to-prod/data-model-factory
     */
    public function __construct(array $context = [])
    {
        $this->context = $context;
    }

    /**
     * Define the class's default values.
     *
     * @return array<string, mixed>
     *
     * @link https://github.com/zero-to-prod/data-model-factory
     */
    private function definition(): array
    {
        return [];
    }

    /**
     * Get a new factory instance for the model
     *
     * @return self
     *
     * @link https://github.com/zero-to-prod/data-model-factory
     * @see  https://github.com/zero-to-prod/data-model
     */
    public static function factory(array $context = []): self
    {
        return new static($context);
    }

    /**
     * Instantiates the class using `$this->context`.
     *
     * @link https://github.com/zero-to-prod/data-model-factory
     * @see  https://github.com/zero-to-prod/data-model
     */
    private function instantiate()
    {
        return $this->model::from(array_merge($this->definition(), $this->context));
    }

    /**
     * Use this to type-hint the proper return in your factory class.
     *
     * ```
     *  public function make(): MyClass
     *  {
     *      return $this->instantiate();
     *  }
     * ```
     *
     * @link https://github.com/zero-to-prod/data-model-factory
     * @see  https://github.com/zero-to-prod/data-model
     */
    public function make()
    {
        return $this->instantiate();
    }

    /**
     * Mutate the context before instantiating the class.
     *
     * ```
     *  public function setValue($value): self
     *  {
     *       return $this->state(['value' => $value]);
     *  }
     *
     *  public function setValueWithClosure($value): self
     *  {
     *      return $this->state(function ($context) use ($value) {
     *          return ['value' => $value];
     *      });
     *  }
     * ```
     *
     * @param  callable|array  $state
     *
     * @return self
     *
     * @link https://github.com/zero-to-prod/data-model-factory
     * @see  https://github.com/zero-to-prod/data-model
     */
    private function state($state): self
    {
        $this->context = array_merge(
            $this->context,
            is_callable($state) ? $state($this->context) : $state
        );

        return $this;
    }
}