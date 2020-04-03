<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditProfileTest extends TestCase
{
    /**
     * @test
     */
    public function 編集画面表示()
    {
        // ユーザーを作成
        $user = factory(User::class)->create();
        // 編集ページにアクセス
        $response = $this->actingAs($user)->get('/edit');

        $response->assertStatus(200);
    }
}
