<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RandomIntegerGenerationService;

class RandomGeneratorController extends Controller
{
    public function index()
    {
        if(\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // 初期表示
            return view('index');
        }
        
        return view('welcome');
    }
    
    public function generate(Request $request)
    {
        $numberContainer = RandomIntegerGenerationService::generate($request);
        
        return response()->json($numberContainer);
    }
}
