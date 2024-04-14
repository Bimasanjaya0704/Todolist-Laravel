<?php

namespace App\Http\Controllers;

use App\Services\TodolistServices;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    private TodolistServices $todolistServices;
    public function __construct(TodolistServices $todolistServices)
    {
        $this->todolistServices = $todolistServices;
    }

    public function todolist(Request $request){
    $todolist = $this->todolistServices->getTodolist();
    return response()->view('user.homePage', [
        'title' => 'Homae',
        'todolist'=> $todolist
    ]);
    }

    public function addTodolist(Request $request){
        $todo = $request->input('todo');
        if(empty($todo)){
            $todolist = $this->todolistServices->getTodolist();
            return response()->view('user.homePage', [
                'title'=> 'Home',
                'todolist'=> $todolist,
                'error' => 'Todo is required'
            ]);
        }

        $this->todolistServices->saveTodo(uniqid(), $todo);
        return redirect()->action([TodolistController::class,'todolist'])->with('success','');
    }

    public function deleteTodolist(Request $request, string $todoId){
        
    }

}
