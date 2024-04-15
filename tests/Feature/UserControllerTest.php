<?php

namespace Tests\Feature;

use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        DB::delete("delete from users");
    }
    public function testLoginPage()
    {
        $this->get('/login')
        ->assertSeeText('Login');
    }

    public function testLoginPageForMember()
    {
       $this->session(['user'=> 'bimas'])
       ->get('/login')
       ->assertRedirect('/');
    }

    public function testLoginSuccess(){
        $this->seed(UserSeeder::class);
        $this->post('/login', [
            'user' => 'bimas@mail.com',
            'password' => 'rahasia',
        ])
        ->assertRedirect('/')
        ->assertSessionHas('user','bimas@mail.com');
    }

    public function testLoginForUserAlreadyLogin(){
        $this->withSession(['user' => 'bimas'])
        ->post('/login', [
            'user'=> 'bimas',
            'password'=> 'rahasia',
        ])
        ->assertRedirect('/');
    }

    public function testLoginError(){
        $this->post('/login', [
            
        ])
        ->assertSeeText('Username and Password is required');
    }

    public function testLoginFailed(){
        $this->post('/login', [
            'user' => 'bimas',
            'password' => 'bimas',
        ])
        ->assertSeeText('Username and Password is wrong');
    }

    public function testLogout(){
        $this->withSession(
            ["user","bimas"]
            )
            ->post('/logout')
            ->assertRedirect('/')
            ->assertSessionMissing('user');
    }

    public function testLogoutGuest(){
       $this->post('/logout')
       ->assertRedirect('/');
    }
}
