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

    public function testLoginSuccess(){
        $this->post('/login', [
            'user' => 'bimas',
            'password' => 'rahasia',
        ])
        ->assertRedirect('/')
        ->assertSessionHas('user','bimas');
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
}
