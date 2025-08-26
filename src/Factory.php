<?php

namespace Zerotoprod\DataModelFactory;

/**
 * @deprecated Use `DataModelFactory` instead.
 *
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
 * @link       https://github.com/zero-to-prod/data-model-factory
 *
 * @see        https://github.com/zero-to-prod/data-model
 */
trait Factory
{
    use DataModelFactory;
}