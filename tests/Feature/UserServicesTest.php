<?php

namespace Tests\Feature;

use App\Services\UserServices;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserServicesTest extends TestCase
{
    private UserServices $userServices;
    protected function setUp(): void
    {
        parent::setUp();
        $this->userServices = $this->app->make(UserServices::class);
    }
    public function testSample()
    {
        self::assertTrue(true);
    }

    public function testLoginSuccess()
    {
        self::assertTrue($this->userServices->login("bimas", "rahasia"));
    }

    public function testLoginWrongPassword()
    {
        self::assertFalse($this->userServices->login("bimas", "bimas"));
    }

    public function testLoginUserNotFound()
    {
        self::assertFalse($this->userServices->login("sanjaya", "bimas"));
    }
}
