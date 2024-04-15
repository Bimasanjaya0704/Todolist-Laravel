<?php

namespace App\Services\Impl;

use App\Models\Todo;
use App\Services\TodolistServices;

class TodolistServicesImpl implements TodolistServices
{
    public function saveTodo(string $id, string $todo): void
    {
        $todo = new Todo([
            "id" => $id,
            "todo" => $todo
        ]);
        
        $todo->save();
    }

    public function getTodolist(): array
    {
        return Todo::all()->toArray();
    }

    public function deleteTodo(string $todoId): void
    {
        $todo = Todo::find($todoId);
        
        if ($todo !== null) {
            $todo->delete();
        }
    }

    public function finishTodo(string $todoId): void
    {
        $todo = Todo::find($todoId);

        if ($todo !== null) {
            $todo->status = 'finished';
            $todo->save();
        }
    }

    public function deleteFinishedTodo(string $todoId): void
    {
        $todo = Todo::find($todoId);

        if ($todo !== null && $todo->status === 'finished') {
            $todo->delete();
        }
    }

    public function getFinishedTodos(): array
    {
        return Todo::where('status', 'finished')->get()->toArray();
    }
}
