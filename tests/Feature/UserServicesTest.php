<?php

namespace Tests\Feature;

use App\Services\UserServices;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserServicesTest extends TestCase
{
    private UserServices $userServices;
    protected function setUp(): void
    {
        parent::setUp();
        DB::delete("delete from users");
        $this->userServices = $this->app->make(UserServices::class);
    }
    public function testSample()
    {
        self::assertTrue(true);
    }

    public function testLoginSuccess()
    {
        $this->seed(UserSeeder::class);
        self::assertTrue($this->userServices->login("bimas@mail.com", "rahasia"));
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
