<?php

namespace Zerotoprod\DataModelFactory;

/**
 * Factory for Instantiating a Class.
 *
 * ```
 *  class UserFactory
 *  {
 *      use Factory;
 *
 *      public string $model = User::class;
 *
 *      public function definition(): array
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
 *      public static function factory(array $context = []): UserFactory
 *      {
 *          return new UserFactory($context);
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
 *
 * @see  https://github.com/zero-to-prod/data-model
 */
trait Factory
{
    /**
     * Stores the values for the class.
     *
     * @var array
     *
     * @link https://github.com/zero-to-prod/data-model-factory
     *
     * @see  https://github.com/zero-to-prod/data-model
     */
    private $context;

    /**
     * Values to instantiate the class.
     *
     * @link https://github.com/zero-to-prod/data-model-factory
     *
     * @see  https://github.com/zero-to-prod/data-model
     */
    public function __construct(array $context = [])
    {
        $this->context = array_merge($this->definition(), $context);
    }

    /**
     * Define the class's default values.
     *
     * @return array<string, mixed>
     *
     * @link https://github.com/zero-to-prod/data-model-factory
     *
     * @see  https://github.com/zero-to-prod/data-model
     */
    private function definition(): array
    {
        return [];
    }

    /**
     * Merge the context with the new values.
     *
     * @link https://github.com/zero-to-prod/data-model-factory
     *
     * @see  https://github.com/zero-to-prod/data-model
     */
    public function merge(array $definition = []): self
    {
        $this->context = array_merge($this->context, $definition);

        return $this;
    }

    /**
     * Merge the context with the new values and return the new context.
     *
     * @return array<string, mixed>
     *
     * @link https://github.com/zero-to-prod/data-model-factory
     *
     * @see  https://github.com/zero-to-prod/data-model
     */
    public function context(): array
    {
        return $this->context;
    }

    /**
     * Get a new factory instance for the model
     *
     * @return self
     *
     * @link https://github.com/zero-to-prod/data-model-factory
     *
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
     *
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
     *
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
     *   public function setValue($value): self
     *   {
     *        return $this->state('value.nested', $value);
     *   }
     *
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
     *
     * @see  https://github.com/zero-to-prod/data-model
     */
    private function state($state, $value = null): self
    {
        if (is_string($state)) {
            $ref = &$this->context;

            foreach (explode('.', $state) as $key) {
                if (!isset($ref[$key]) || !is_array($ref[$key])) {
                    $ref[$key] = [];
                }
                $ref = &$ref[$key];
            }

            $ref = $value;

            return $this;
        }

        $this->context = array_merge(
            $this->context,
            is_callable($state) ? $state($this->context) : $state
        );

        return $this;
    }

    /**
     * Mutate the context before instantiating the class.
     *
     * ```
     *   public function setValue($value): self
     *   {
     *        return $this->state('value.nested', $value);
     *   }
     *
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
     *
     * @see  https://github.com/zero-to-prod/data-model
     */
    public function set($state, $value = null): self
    {
        $this->state($state, $value);

        return $this;
    }
}