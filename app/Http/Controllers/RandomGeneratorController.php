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
        $fromNum = (int) $request->from_num;
        $toNum = (int) $request->to_num;
        $count = (int) $request->count;
        $sumNum = (int) $request->sum_num;
        $forwardFix = (int) $request->forward_fix;
        $backwardFix = (int) $request->backward_fix;
        $exclusion = (int) $request->exclusion;
        
        $numberContainer = [];
        
        $i = 0;
        do {
            $generateNum = mt_rand($fromNum, $toNum);
            
            if (!in_array($generateNum, $numberContainer, true)){
                //配列に$generateNumを追加する
                $numberContainer[] = $generateNum;
                $i++;
            }
        } while ($i < $count);
        
        sort($numberContainer, SORT_ASC);
        
        dd($numberContainer);
    }
}
