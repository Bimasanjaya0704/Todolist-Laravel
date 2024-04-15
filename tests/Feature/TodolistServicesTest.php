<?php

namespace Tests\Feature;

use App\Services\TodolistServices;
use Database\Seeders\TodoSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Testing\Assert;
use Tests\TestCase;

class TodolistServicesTest extends TestCase
{
    private TodolistServices $todolistServices;
    protected function setUp(): void
    {
        parent::setUp();

        DB::delete("delete from todos");
        $this->todolistServices = $this->app->make(TodolistServices::class);
    }
    public function testTodolistNotNull()
    {
        self::assertNotNull($this->todolistServices);
    }

    public function testTodo(){
        $this->todolistServices->saveTodo("1", "bimas");

        $todolist = $this->todolistServices->getTodolist() ;
        foreach( $todolist as $value ){
            self::assertEquals('1', $value['id']);
            self::assertEquals('bimas', $value['todo']);
        }
    }
    
    public function getTodolistEmpty()
    {
        self::assertEquals([], $this->todolistServices->getTodolist());
    }

    public function testTodolistNotEmpty()
    {
        $expected = [
            ['id'=> '1','todo'=> 'bimas', 'status' => 'unfinished'],
            ['id'=> '2','todo'=> 'sanjaya', 'status' => 'unfinished'],  
        ];

        $this->todolistServices->saveTodo('1', 'bimas',);
        $this->todolistServices->saveTodo('2', 'sanjaya');

        Assert::assertArraySubset($expected, $this->todolistServices->getTodolist());
    }

    public function testDeleteTodo()
    {
        
        $this->todolistServices->saveTodo('1', 'bimas');
        $this->todolistServices->saveTodo('2', 'sanjaya');

        self::assertEquals(2, sizeof($this->todolistServices->getTodolist()));

        $this->todolistServices->deleteTodo('3');
        self::assertEquals(2, sizeof($this->todolistServices->getTodolist()));

        $this->todolistServices->deleteTodo('1');
        self::assertEquals(1, sizeof($this->todolistServices->getTodolist()));

        $this->todolistServices->deleteTodo('2');
        self::assertEquals(0, sizeof($this->todolistServices->getTodolist()));
    }
}
