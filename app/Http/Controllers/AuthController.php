<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        // バリデーションのチェック
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        // ユーザー情報の作成
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        // tokenの発行
        $token = $user->createToken($user->name)->plainTextToken;

        // レスポンスデータ
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request) {
        // バリデーションのチェック
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        // emailからUserデータを取得
        $user = User::where('email', $fields['email'])->first();

        // emailとpasswordが正しいかの確認
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        // tokenの発行
        $token = $user->createToken($user->name)->plainTextToken;

        // レスポンスデータ
        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response()->json($response, 201);
    }

    public function logout() {
        // tokenの削除
        auth()->user()->tokens()->delete();

        return response(['message' => 'ok'], 200);
    }
}
