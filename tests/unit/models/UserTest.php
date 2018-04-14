<?php

namespace tests\models;

use app\entities\User;

class UserTest extends \Codeception\Test\Unit
{
    public function testFindUserById()
    {
        expect_that($user = User::findIdentity(100));
        expect($user->username)->equals('Sergalas');

        expect_not(User::findIdentity(999));
    }

    

    public function testFindUserbyLogin()
    {
        expect_that($user = User::findUserbyLogin('Sergalas'));
        expect_not(User::findUserbyLogin('not-admin'));
    }

  
}
