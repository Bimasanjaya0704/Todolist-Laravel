<?php

namespace Tests\Feature;

use Database\Seeders\TodoSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        DB::delete("delete from todos");
    }

    public function testTodolist()
    {
        $this->seed(TodoSeeder::class);
        $this->withSession([            
                "user" =>"bimas"
            ])->get("/todolist")
            ->assertSeeText("1")
            ->assertSeeText("bimas")
            ->assertSeeText("2")
            ->assertSeeText("sanjaya");
    }

    public function testAddTodoFailed()
    {
        $this->withSession([            
                "user" =>"bimas"
            ])->post("/todolist", [])
            ->assertSeeText("Todo is required");
    }

    public function testAddTodoSuccess()
    {
        $this->withSession([            
                "user" =>"bimas"
            ])->post("/todolist", [
                "todo"=> 'bimas'
            ])
            ->assertRedirect('/todolist');
    }

    public function testDeleteTodo()
    {
        $this->withSession([            
            "user" =>"bimas",
            "todolist"=> [
                [
                    "id"=> "1",
                    "todo"=> "sans",
                ],
                [
                    "id"=> "2",
                    "todo"=> "sanjaya",
                ]
            ]
        ])->post("/todolist/1/delete")
            ->assertRedirect('/todolist');
    }
    
}
