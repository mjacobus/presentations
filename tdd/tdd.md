TDD - Desenvolvimento guiado por testes
--------------------------------------------------------------------------------

O que é?

Por quê?

PHPUnit
--------------------------------------------------------------------------------

# TDD

- Test Driven Development
- Test First
- Red - Green Refactoring

Gimme some Code!
-------------------------------------------------------------------------------

Crie sua classe.

```php
<?php
// lib/App/User.php

namespace App;

class User
{
    public function __construct($name, $lastName)
    {
    }
}
```
Crie sua classe de testes

```php

<?php

// tests/AppTests/UserTest.php

namespace AppTests;

use App\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testGetCompleteNameReturnsCompleteName()
    {
        // Setup
        $user = new User("Jon", "Doe");

        // Exercise
        $completeName = $user->getCompleteName();

        // Verify
        $this->assertEquals("Jon Doe", $completeName);
    }
}
```

Rode o teste. Ele deve falhar.

    $ phpunit tests

    PHP Fatal error:  Class 'App\User' not found in /codepath/tests/AppTests/UserTest.php on line 12
    PHP Stack trace:
    PHP   1. {main}() /usr/local/bin/phpunit.phar:0
    PHP Fatal error:  Class 'App\User' not found in /codepath/code/tests/AppTests/UserTest.php on line 12
    PHP Stack trace:
    [...]

Oops, precisamos fazer o require da classe (ou melhor, use algum autoloader, do composer de preferência). Vamos de require por enquanto

```php
<?php
// tests/AppTest/UserTest.php
//
namespace AppTests;

use App\User;

require_once dirname(__FILE__) . "/../../lib/App/User.php";
// [...]
```

Rode o teste novamente

    phpunit tests

    PHPUnit 3.7.32 by Sebastian Bergmann.

    PHP Fatal error:  Call to undefined method App\User::getCompleteName() in /codepath/tests/AppTests/UserTest.php on line 17
    PHP Stack trace:
    [...]

Hum... esquecemos de criar o método. Crie.



```php
<?php

// lib/App/User.php

namespace App;

class User
{
    public function __construct($name, $lastName)
    {
    }

    public function getCompleteName()
    {
    }
}
```

Rode o teste

    phpunit tests

    PHPUnit 3.7.32 by Sebastian Bergmann.

    F

    Time: 7 ms, Memory: 6.00Mb

    There was 1 failure:

    1) AppTests\UserTest::testGetCompleteNameReturnsCompleteName
    Failed asserting that null matches expected 'Jon Doe'.

    /codepath/tests/AppTests/UserTest.php:20

    FAILURES!
    Tests: 1, Assertions: 1, Failures: 1.

Yay! Este é o erro que queriamos ver. Note o "F" no resultado. E note o erro.

Agora nós só precisamos implementar o método de maneira que o teste passe!

```php
<?php

// lib/App/User.php

namespace App;

class User
{
    private $name;
    private $lastName;

    public function __construct($name, $lastName)
    {
        $this->name     = $name;
        $this->lastName = $lastName;
    }

    public function getCompleteName()
    {
        return implode(" ", array(
            $this->name,
            $this->lastName,
        ));
    }
}
```


    PHPUnit 3.7.32 by Sebastian Bergmann.

    .

    Time: 5 ms, Memory: 5.75Mb

    OK (1 test, 1 assertion)

Yay! Agora nosso teste passou. Refatore, rode os testes.

Talvez o seu código melhore, fique mais simples...

```php
<?php

// lib/App/User.php

namespace App;

class User
{
    private $name;
    private $lastName;

    public function __construct($name, $lastName)
    {
        $this->name     = $name;
        $this->lastName = $lastName;
    }

    public function getCompleteName()
    {
        return $this->name . " " . $this->lastName;
    }
}
```

Ou não...

```php

<?php

// lib/App/User.php

namespace App;

class User
{
    private $name;
    private $lastName;

    public function __construct($name, $lastName)
    {
        $this->name     = $name;
        $this->lastName = $lastName;
    }

    public function getCompleteName()
    {
        ob_start();
        echo $this->name;
        echo " ";
        echo $this->lastName;
        return ob_get_clean();
    }
}
```

Mas o importante é que ele vai continuar funcionando...


    PHPUnit 3.7.32 by Sebastian Bergmann.

    .

    Time: 5 ms, Memory: 5.75Mb

    OK (1 test, 1 assertion)
