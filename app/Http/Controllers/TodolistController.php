<?php

namespace App\Http\Controllers;

use App\Services\TodolistService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodolistController extends Controller
{
    private TodolistService $todolistService;

    public function __construct(TodolistService $todolistService)
    {
        $this->todolistService = $todolistService;
    }

    public function todoList(Request $request): Response
    {
        $todolist = $this->todolistService->getTodoList();
        return response()
            ->view('todolist',[
                "title" => "Todolist",
                "todolist" => $todolist
            ]);
    }

    public function addTodo(Request $request)
    {
        $todo = $request->input('todo');

        if(empty($todo)){
            $todoList = $this->todolistService->getTodoList();
            return \response()->view("todolist",[
                'title' => 'Todolist',
                'todolist' => $todoList,
                'error' => "Todo is required"
            ]);
        }
        $this->todolistService->saveTodo(uniqid(), $todo);
        return redirect()->action([TodolistController::class,'todoList']);
    }

    public function removeTodo(Request $request, string $todoId): RedirectResponse
    {
        $this->todolistService->removeTodo($todoId);
        return redirect()->action([TodolistController::class,'todoList']);
    }


}
