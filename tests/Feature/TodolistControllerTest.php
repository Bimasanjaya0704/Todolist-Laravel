<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TodolistControllerTest extends TestCase
{

    public function testTodolist()
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
            ])->get("/todolist")
            ->assertSeeText("1")
            ->assertSeeText("sans")
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
