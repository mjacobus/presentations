<?php
// tests/AppTest/UserTest.php
//
namespace AppTests;

use App\User;

require_once dirname(__FILE__) . "/../../lib/App/User.php";

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
