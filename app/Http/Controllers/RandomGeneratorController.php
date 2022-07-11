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
    
    public function generate(Request $request)
    {
        $fromNum = $request->from_num;
        $toNum = $request->to_num;
        $count = $request->count;
        $sumNum = $request->sum_num;
        $forwardFix = $request->forward_fix;
        $backwardFix = $request->backward_fix;
        $exclusion = $request->exclusion;
        
        # dd($fromNum, $toNum, $count, $sumNum, $forwardFix, $backwardFix, $exclusion);
        for ($i = 0 ; $i < $count ; $i++){
            $numbers = mt_rand($fromNum, $toNum);
        }
    }
}
