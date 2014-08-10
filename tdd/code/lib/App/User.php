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
