<?php

namespace App\Services\Impl;

use App\Services\TodolistServices;
use Illuminate\Support\Facades\Session;

class TodolistServicesImpl implements TodolistServices
{
    public function saveTodo(string $id, string $todo): void
    {
        if (!Session::has('todolist')) {
            Session::put('todolist', []);
        }

        $todolist = Session::get('todolist');
        $todolist[] = [
            'id' => $id,
            'todo' => $todo,
            'status' => 'unfinished', // Tambahkan status 'unfinished' saat menyimpan todo baru
        ];

        Session::put('todolist', $todolist);
    }

    public function getTodolist(): array
    {
        return Session::get('todolist', []);
    }

    public function deleteTodo(string $todoId): void
    {
        $todolist = Session::get('todolist');

        foreach ($todolist as $index => $todo) {
            if ($todo['id'] === $todoId) {
                unset($todolist[$index]);
                break;
            }
        }

        Session::put('todolist', $todolist);
    }

    public function finishTodo(string $todoId): void
    {
        $todolist = Session::get('todolist');
    
        foreach ($todolist as $index => $todo) {
            if ($todo['id'] === $todoId) {
                $todolist[$index]['status'] = 'finished';
                break;
            }
        }
    
        Session::put('todolist', $todolist);
    }
    
    public function deleteFinishedTodo(string $todoId): void
    {
        $todolist = Session::get('todolist');
    
        foreach ($todolist as $index => $todo) {
            if ($todo['id'] === $todoId && $todo['status'] === 'finished') {
                unset($todolist[$index]);
                break;
            }
        }
    
        Session::put('todolist', $todolist);
    }
    

    public function getFinishedTodos(): array
    {
        $todolist = Session::get('todolist', []);
        $finishedTodos = array_filter($todolist, function ($todo) {
            return isset($todo['status']) && $todo['status'] === 'finished';
        });

        return $finishedTodos;
    }
}
