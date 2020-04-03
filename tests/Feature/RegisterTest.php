<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    // public function a()
    // {
    //     dd(env('APP_ENV'), env('DB_HOST'));
    //     parent::setUp();
    // }
    public function should_新しいユーザーを作成して返却する()
    {

        $data = [
            'name' => 'crypto',
            'email' => 'dummy@email.com',
            'password' => 'test1234',
            'password_confirmation' => 'test1234',
        ];

        $response = $this->json('POST', route('register'), $data);

        $user = User::first();
        $this->assertEquals($data['name'], $user->name);

        $response
            ->assertStatus(302);
    }
}
