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
trait DataModelFactory
{
    use \Zerotoprod\Factory\Factory;

    /**
     * Instantiates the class using `$this->context`.
     *
     * @link https://github.com/zero-to-prod/data-model-factory
     *
     * @see  https://github.com/zero-to-prod/data-model
     */
    private function instantiate(array $context = [])
    {
        return $this->model::from($this->resolve($context));
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
    public function make(array $context = [])
    {
        return $this->instantiate($context);
    }
}