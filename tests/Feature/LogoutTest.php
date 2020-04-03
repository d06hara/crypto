<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LogoutTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */


    /**
     * @test
     */
    public function ログアウト()
    {
        // ユーザーを１つ作成
        $user = factory(User::class)->create();

        // 認証済み、つまりログイン済みしたことにする
        $this->actingAs($user);

        // 認証されていることを確認
        $this->assertTrue(Auth::check());

        // ログアウトを実行
        $response = $this->post('logout');

        // 認証されていない
        $this->assertFalse(Auth::check());

        // ログインページにリダイレクトすることを確認
        $response->assertRedirect('/login');
    }
}
