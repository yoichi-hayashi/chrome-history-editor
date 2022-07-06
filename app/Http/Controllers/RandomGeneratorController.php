<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RandomGeneratorController extends Controller
{
    public function index()
    {
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // 初期表示
            return view('index');
        }
        
        return view('welcome');
    }
}
