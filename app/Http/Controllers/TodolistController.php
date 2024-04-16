<?php

namespace App\Http\Controllers;

use App\Services\TodolistServices;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TodolistController extends Controller
{
    private TodolistServices $todolistServices;

    public function __construct(TodolistServices $todolistServices)
    {
        $this->todolistServices = $todolistServices;
    }

    public function todolist(Request $request)
{
    // Dapatkan ID pengguna yang sedang login
    $userId = $request->user()->id;

    // Ambil todo hanya untuk pengguna yang sedang login
    $todolist = $this->todolistServices->getTodolist($userId);
    
    return response()->view('user.homePage', [
        'title' => 'Home',
        'todolist' => $todolist
    ]);
}


    public function addTodolist(Request $request)
{
    $todo = $request->input('todo');
    if (empty($todo)) {
        $userId = $request->user()->id;
        $todolist = $this->todolistServices->getTodolist($userId);
        return response()->view('user.homePage', [
            'title' => 'Home',
            'todolist' => $todolist,
            'error' => 'Todo is required'
        ]);
    }

    // Dapatkan ID pengguna yang sedang login
    $userId = $request->user()->id;

    $this->todolistServices->saveTodo(uniqid(), $todo, $userId); // Kirimkan user_id
    return redirect()->action([TodolistController::class, 'todolist'])->with('success', '');
}


    public function deleteTodolist(Request $request, string $todoId): RedirectResponse
    {
        $this->todolistServices->deleteTodo($todoId);
        return redirect()->action([TodolistController::class, 'todolist']);
    }

    public function finishTodo(string $todoId)
    {
        $this->todolistServices->finishTodo($todoId);
        
        // Redirect to the todo list page
        return redirect()->action([TodolistController::class, 'todolist'])->with('success', 'Item todo ditandai sebagai selesai.');
    }
    
}
