<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
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
        $this->post('/login', [
            'user' => 'bimas',
            'password' => 'rahasia',
        ])
        ->assertRedirect('/')
        ->assertSessionHas('user','bimas');
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
