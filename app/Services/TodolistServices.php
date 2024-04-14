<?php

namespace App\Services;

interface TodolistServices
{
    public function saveTodo(string $id, string $todo): void;

    public function getTodolist(): array;

    public function deleteTodo(string $todoId);

    public function finishTodo(string $todoId): void;

    public function getFinishedTodos(): array;
}