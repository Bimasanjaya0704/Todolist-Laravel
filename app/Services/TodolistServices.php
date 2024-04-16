<?php

namespace App\Services;

interface TodolistServices
{
    public function saveTodo(string $id, string $todo, int $userId): void;

    public function getTodolist(int $userId): array;

    public function deleteTodo(string $todoId);

    public function finishTodo(string $todoId): void;

    public function getFinishedTodos(): array;
}