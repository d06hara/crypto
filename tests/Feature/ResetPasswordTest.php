<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ResetPasswordTest extends TestCase
{
    /**
     * @test
     * パスワードリセットをリクエストする画面の閲覧可能
     */
    public function user_can_view_reset_request()
    {
        $response = $this->get('password/reset');

        $response->assertStatus(200);
    }

    /**
     * @test
     * パスワードリセットのリクエスト成功
     */
    public function valid_user_can_request_reset()
    {
        // ユーザーを1つ作成
        $user = factory(User::class)->create();

        // パスワードリセットをリクエスト
        $response = $this->from('password/email')->post('password/email', [
            'email' => $user->email,
        ]);

        // 同画面にリダイレクト
        $response->assertStatus(302);
        $response->assertRedirect('password/email');
        // 成功のメッセージ
        $response->assertSessionHas(
            'status',
            'パスワードリセットリンクが電子メールで送信されました'
        );
    }
    /**
     * @test
     * 存在しないメールアドレスでパスワードリセットのリクエストをして失敗
     */
    public function invalid_user_cannot_request_reset()
    {
        // ユーザーを1つ作成
        $user = factory(User::class)->create();

        // 存在しないユーザーのメールアドレスでパスワードリセットをリクエスト
        $response = $this->from('password/email')->post('password/email', [
            'email' => 'nobody@example.com'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('password/email');
        // 失敗のエラーメッセージ
        $response->assertSessionHasErrors(
            'email',
            '指定のメールアドレスは見つかりませんでした'
        );
    }
}
