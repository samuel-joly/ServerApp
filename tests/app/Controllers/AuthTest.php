<?php

namespace App\Database;

use CodeIgniter\Test\CIDatabaseTestCase;

class MyTests extends CIDatabaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        var_dump($this->DBGroup);
    }

    public function testLogin() {
        return true;
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }
}
