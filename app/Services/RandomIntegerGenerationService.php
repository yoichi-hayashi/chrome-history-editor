<?php
namespace App\Services;
use Illuminate\Http\Request;

class RandomIntegerGenerationService
{
    public static function generate(Request $request)
    {
        // 範囲の最小値、最大値、生成個数、合計する数、前方固定、後方固定、除外する数を変数に格納
        $minNum = $request->minNum;
        $maxNum = $request->maxNum;
        $count = $request->count;
        $sumNum = $request->sumNum;
        $forwardStationary = $request->forwardStationary;
        $backwardStationary = $request->backwardStationary;
        $exclusion = $request->exclusion;
        
        $numberContainer = [];
        
        $i = 0;
        
        fixed_generate:
        do {
            /* 
                生成したい乱数の桁数から前方固定と後方固定の桁数を除いたものを変数に格納
                (例.100000～200000、つまり6桁の乱数を生成し、前方固定が13、後方固定が8の場合、
                生成される乱数は13XXX8の形になる。よって$generateNumLengthでXXXの桁数を取得して
                格納している。)
            */
            $randomNumLength = strlen($minNum) - (strlen($forwardStationary) + strlen($backwardStationary));
            // 10の累乗を用いて最小値と最大値を表し、XXXと同じ桁数(この場合は3桁)の乱数を生成
            // 以下、XXXの部分のみの乱数を中間乱数と呼ぶ
            $randomStart = substr($minNum, strlen($forwardStationary), $randomNumLength);
            if((int)$randomStart < 10**($randomNumLength - 1)) {
                $randomStart = (int)$randomStart + 10**($randomNumLength - 1);
            }
            $randomEnd = substr($maxNum, strlen($forwardStationary), $randomNumLength);
            if((int)$randomEnd < 10**($randomNumLength - 1)) {
                $randomEnd = (10**$randomNumLength) - 1;
            }
            $randomNum = mt_rand((int)$randomStart, (int)$randomEnd);
            // 生成される乱数は隣り合う数字が全て異なるものにしたい
            // 生成される中間乱数の最初(一番左)の数字を変数に格納
            $randomNumInit = ((string)$randomNum)[0];
            // 生成される中間乱数の最後(一番右)の数字を変数に格納
            $randomNumEnd = (string)($randomNum % 10);
            // 前方固定部の最後の数字を変数に格納
            $forwardEnd = $forwardStationary[strlen($forwardStationary) - 1];
            // 後方固定部の最初の数字を変数に格納
            $backwardInit = $backwardStationary[0];
            /* 
                生成された中間乱数の最初の数字と前方固定部の最後の数字が同じ、
                または生成された中間乱数の最後の数字と後方固定部の最初の数字が同じなら
                処理を最初からやり直す
            */
            if($randomNumInit === $forwardEnd || $randomNumEnd === $backwardInit) {
                goto fixed_generate;
            }
            // 生成された中間乱数を文字列型に変換
            $randomNumStr = (string)$randomNum;
            $randomArray = [];
            /*
                文字列型に変換した中間乱数を一文字ずつ$randomArrayの中に存在するかどうか調べ、
                なければ$randomArrayに追加、あれば処理を最初からやり直す
                これによってまずは中間乱数だけを指定個数分生成した配列が出来上がる
            */
            for($j = 0; $j < $randomNumLength; $j++) {
                if(!in_array($randomNumStr[$j], $randomArray, true)) {
                    $randomArray[] = $randomNumStr[$j];
                } else {
                    goto fixed_generate;
                }
            }
            /*
                まずwordwrap($exclusion, 1, ",", true)で$exclusion、すなわち除外する数の
                フォームに入力した数字を一文字ずつ","を用いて分割する
                すると、例えば除外する数に「123」と入力していた場合、処理結果は
                1,2,3
                となる
                次に、explode()を用いて","で先ほどの処理結果を区切って一要素とし、$excludesに配列として格納する
            */
            $excludes = explode(",", wordwrap($exclusion, 1, ",", true));
            /*
                中間乱数(XXX)の桁数分ループを回し、中間乱数を一文字ずつ$excludesの中に存在するか調べ、
                なければ追加、あれば処理を最初からやり直す
            */
            for($j = 0; $j < $randomNumLength; $j++) {
                if(!in_array($randomNumStr[$j], $excludes, true)) {
                    $excludes[] = $randomNumStr[$j];
                } else {
                    goto fixed_generate;
                }
            }
            // 前方固定+中間乱数+後方固定の形に結合させる
            $formedNumStr = (string)$forwardStationary . (string)$randomNum . (string)$backwardStationary;
            // 文字列型だった乱数を整数型に変換
            $formedNum = (int)$formedNumStr;
            // 乱数が$numberContainerの中に存在するか調べ、なければ追加する
            if(!in_array($formedNum, $numberContainer, true)) {
                // 配列に$randomNumを追加する
                $numberContainer[] = $formedNum;
                $i++;
            }
            
        } while($i < $count);
        
        sort($numberContainer, SORT_ASC);
        
        return $numberContainer;
    }

}