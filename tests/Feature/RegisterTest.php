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

    public function 新しいユーザーを作成して返却する()
    {

        $data = [
            'name' => 'crypto',
            'email' => 'dummy@email.com',
            'password' => 'test1234',
            'password_confirmation' => 'test1234',
        ];

        $response = $this->json('POST', route('register'), $data);

        $user = User::orderBy('created_at', 'desc')->first();
        $this->assertEquals($data['name'], $user->name);

        $response
            ->assertStatus(302);
    }
}
