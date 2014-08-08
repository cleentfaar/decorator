# Usage

In this chapter I will take you the process of creating a decorator factory and using it to decorate a value of your choice.

## About this example

This example is about a scenario where we have a `UserModel` which is used to map user-data to a database, and we want
to use it to display some information to the visitor.

Let's say you want to display the user's age somewhere. Storing that in the database is rather silly (what's the point
if the user has to update it themselves each year), so you are better off using some `date_of_birth` field to determine
the age from. But, adding methods like `getAge` turns the object that once had only one responsibility (mapping data)
into one that has two (representing data).

So, you are better off having a separate object that has the necessary methods (like `getAge()`) which you can
safely use in any of your site's HTML.

This is why I created this library. It easily let's you create such 'decorators', and use them to represent any value you
want them to (not just objects!).


## 1) Creating a decorator factory

Okay let's say we have a UserModel like this:

```php
// Acme\Model\UserModel

namespace Acme\Model;

class UserModel
{
    /**
     * @var \DateTime
     */
    protected $dateOfBirth;

    // ... OTHER FIELDS / METHODS ...

    /**
     * @return \DateTime
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }
}
```

You then create a decorator for it like this:


```php


<?php

namespace Acme\Decorator;

use Acme\Model\UserModel;
use CL\Decorator\AbstractDecorator;

/**
 * Decorates a User object
 */
class UserDecorator extends AbstractDecorator
{
    /**
     * @var UserModel
     */
    protected $user;

    /**
     * Constructor.
     *
     * @param User $user
     */
    public function __construct(UserModel $user)
    {
        $this->user = $user;
    }

    /**
     * Returns the user's age
     *
     * @return integer
     */
    public function getAge()
    {
        $dob = $this->user->getDateOfBirth();

        if ($dob instanceof \DateTime) {
            return $dob->diff(new \DateTime())->format('%y');
        }
    }

    /**
     * @return UserModel
     */
    protected function getOriginalValue()
    {
        return $this->user;
    }
}
```

And a factory that creates your decorators like this:

```php
<?php

namespace Acme\Decorator;

use Acme\Model\UserModel;
use CL\Decorator\Factory\DecoratorFactoryInterface;

/**
 * Creates a UserDecorator from a given UserModel
 */
class UserDecoratorFactory extends DecoratorFactoryInterface
{
    /**
     * Constructor.
     *
     * @param UserModel $user
     */
    public function decorate($user)
    {
        return new UserDecorator($user);
    }

    /**
     * {@inheritdoc}
     */
    public function supports($originalValue)
    {
        return $originalValue instanceof UserModel;
    }
}
```


## 2) Using the factory

### Method a) Directly

This is the easiest way, and is enough if you just need to decorate a specific value and know what type it is.

```php
$user                 = new UserModel();
$userDecoratorFactory = new UserDecoratorFactory();
// ...
$user->setDateOfBirth(new \DateTime('-27 years'));
// ...
$userDecorator        = $userDecoratorFactory->decorate($user);

// display the age in your HTML
echo $userDecorator->getAge();
```

### Method b) Using delegation

If you have to decorate more than one value, or don't know what type it may be at any time, you are better off using
an instance of `DelegatingDecoratorFactory`. Although this requires some more steps to implement, it's worth the time
if you are aiming for flexibility over strictness.

Assuming you created the `UserDecoratorFactory` mentioned above, here is how you would set it up:

```php
// $userModel = $myDb->getModel('user', 123);

$delegatingDecoratorFactory = new DelegatingDecoratorFactory();
$delegatingDecoratorFactory->registerFactory(new UserDecoratorFactory());
$delegatingDecoratorFactory->registerFactory('...'); // more factories if you need them...

// ...

// Create the decorator without knowing which factory to use
$userDecorator = $delegatingDecoratorFactory->decorate($userModel); // UserDecorator

// display the age in your HTML
echo $userDecorator->getAge();
```
