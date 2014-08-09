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


## 1) Creating a decorator

Okay let's say we have a UserModel like this:

```php
<?php
// src/Acme/Model/UserModel.php

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
// src/Acme/Decorator/UserDecorator.php

namespace Acme\Decorator;

use Acme\Model\UserModel;
use CL\Decorator\AbstractDecorator;

/**
 * Decorates a User object
 */
class UserDecorator extends ObjectDecorator
{
    /**
     * Returns the user's age
     *
     * @return integer
     */
    public function getAge()
    {
        $dob = $this->getOriginalValue()->getDateOfBirth();

        if ($dob instanceof \DateTime) {
            return $dob->diff(new \DateTime())->format('%y');
        }
    }

    /**
     * {@inheritdoc}
     */
    public function supports()
    {
        return $originalValue instanceof UserModel;
    }
}
```

--NOTE: By extending `MagicObjectDecorator` instead of `ObjectDecorator` you allow your decorator to access the
--original object's methods if the one you are calling does not exist in the decorator. For more information on this,
--check out the actual class [here](../../AbstractMagicDecorator.php).


## 2) Using the decorator

### Method a) Directly

This is the easiest way, and is enough if you just need to decorate a specific value and know what type it is.

```php
// ...

$user = new UserModel();
$user->setDateOfBirth(new \DateTime('-27 years'));

// ...

$userDecorator = new UserDecorator();
$userDecorator = $userDecorator->inject($user);

// how you could display the age in your HTML
echo $userDecorator->getAge();
```

### Method b) Using the delegating decorator

If you have to decorate more than one value, or don't know what type it may be at any time, you are better off using
an instance of the `DelegatingDecorator` class. Although this requires some more steps to implement, it's worth the
time if you are aiming for flexibility over strictness.

Assuming you created the `UserDecorator` mentioned above, here is how you would set it up:

```php
// $userModel = $myDb->getModel('user', 123);

$delegatingDecoratorFactory = new DelegatingDecorator();
$delegatingDecoratorFactory->registerDecorator(new UserDecorator());
$delegatingDecoratorFactory->registerDecorator(new ArrayDecorator()); // just an example there can be more

// ...

// Create the decorator without knowing which factory to use
$userDecorator = $delegatingDecorator->decorate($userModel); // returns instance of UserDecorator

// display the age in your HTML
echo $userDecorator->getAge();

// or, if your decorator extended the AbstractMagicDecorator:
echo $userDecorator->age();
echo $userDecorator->getAge();
echo $userDecorator->dateOfBirth();
echo $userDecorator->getDateOfBirth();
```
