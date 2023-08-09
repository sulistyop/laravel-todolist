<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')
            ->assertSeeText("Login");
    }

    public function testLoginPageForMember()
    {
        $this->withSession([
            "user" => "sulis"
        ])->get('/login')
            ->assertRedirect('/');
    }
    public function testLoginPageForUserAlreadyLogin()
    {
        $this->withSession([
            "user" => "sulis"
        ])->post('/login', [
            "user" => "sulis",
            "password" => "rahasia",
        ])->assertRedirect('/');
    }

    public function testLoginSuccess()
    {
        $this->post('/login', [
            "user" => "sulis",
            "password" => "rahasia"
        ])->assertRedirect('/');
    }
    public function testLoginValidationError()
    {
        $this->post('/login', [])
            ->assertSeeText("User or password is required");
    }
    public function testLoginFailed()
    {
        $this->post('/login', [
            "user" => "salah",
            "password" => "salah"
        ])->assertSeeText("User or password is wrong");
    }

    public function testLogout()
    {
        $this->withSession([
            "user" => "sulis",
            "password" => "rahasia",
        ])->post('/logout')
            ->assertRedirect('/')
            ->assertSessionMissing("user");
    }

    public function testLogoutGuest()
    {
        $this->post('/logout')
            ->assertRedirect('/');
    }





}
