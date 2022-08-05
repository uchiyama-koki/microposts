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
        
        // 会員一覧ビューでそれを表示
        return view('users.show', [
            'user' => $user,
        ]);
    }
}
