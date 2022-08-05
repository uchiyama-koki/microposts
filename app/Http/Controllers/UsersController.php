<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User; // 追記

class UsersController extends Controller
{
    public function index() 
    {
        // 会員一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10);
        
        // 会員一覧ビューでそれを表示
        return view('users.index', [
            'users' => $users,
        ]);
    }
    public function show($id)
    {
        // idから会員を検索し取得
        $user = User::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザの投稿一覧を作成日時の降順で取得
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);
        
        // 会員一覧ビューでそれらを表示
        return view('users.show', [
            'user' => $user,
            'microposts' => $microposts,
        ]);
    }
}
