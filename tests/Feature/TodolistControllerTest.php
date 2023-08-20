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
            "user" => "sulis",
            "todolist" => [
               [
                   "id"=> 1,
                   "todo" => "Sulis"
               ],
               [
                   "id"=> 2,
                   "todo" => "Bakwan"
               ],
            ]
        ])->get('/todolist')
            ->assertSeeText(1)
            ->assertSeeText('Sulis')
            ->assertSeeText(2)
            ->assertSeeText('Bakwan');
    }

    public function testAddTodoFailed()
    {
        $this->withSession([
            "user" => "Sulis"
        ])->post('/todolist')
            ->assertSeeText('Todo is required');
    }
    public function testAddTodoSuccess()
    {
        $this->withSession([
            "user" => "Sulis"
        ])->post('/todolist',[
            "todo" => "Eko"
        ])
            ->assertRedirect('/todolist');
    }

    public function testRemoveTodolist()
    {
        $this->withSession([
            "user" => "sulis",
            "todolist" => [
                [
                    "id"=> 1,
                    "todo" => "Sulis"
                ],
                [
                    "id"=> 2,
                    "todo" => "Bakwan"
                ],
            ]
        ])->post('/todolist/1/delete')
            ->assertRedirect('/todolist');
    }


}
