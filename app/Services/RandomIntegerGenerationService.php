<?php
namespace App\Services;
use Illuminate\Http\Request;

class RandomIntegerGenerationService
{
    public static function generate(Request $request)
    {
        // 範囲の最小値、最大値、生成個数、合計する数、前方固定、後方固定、除外する数を変数に格納
        $rangeMin = $request->rangeMin;
        $rangeMax = $request->rangeMax;
        $count = $request->count;
        $addValue = $request->addValue;
        $prefix = $request->prefix;
        $suffix = $request->suffix;
        $exclusion = $request->exclusion;
        
        $numberArray = [];
        
        $i = 0;
        
        fixed_generate:
        do {
            /* 
                生成したい乱数の桁数から前方固定と後方固定の桁数を除いたものを変数に格納
                (例.100000～200000、つまり6桁の乱数を生成し、前方固定が13、後方固定が8の場合、
                生成される乱数は13XXX8の形になる。よって$digitでXXXの桁数を取得して格納する。)
            */
            $digit = strlen($rangeMin) - (strlen($prefix) + strlen($suffix));
            // 10の累乗を用いて最小値と最大値を表し、XXXと同じ桁数(この場合は3桁)の乱数を生成
            // 以下、XXXの部分のみの乱数を中間乱数と呼ぶ
            $middleRandomRangeMin = substr($rangeMin, strlen($prefix), $digit);
            if((int)$middleRandomRangeMin < 10**($digit - 1)) {
                $middleRandomRangeMin = (int)$middleRandomRangeMin + 10**($digit - 1);
            }
            $middleRandomRangeMax = substr($rangeMax, strlen($prefix), $digit);
            if((int)$middleRandomRangeMax < 10**($digit - 1)) {
                $middleRandomRangeMax = (10**$digit) - 1;
            }
            $middleRandom = mt_rand((int)$middleRandomRangeMin, (int)$middleRandomRangeMax);
            // 生成される乱数は隣り合う数字が全て異なるものにしたい
            // 生成される中間乱数の最初(一番左)の数字を変数に格納
            $middleRandomFirst = (substr((string)$middleRandom, 0, 1));
            // 生成される中間乱数の最後(一番右)の数字を変数に格納
            $middleRandomLast = (string)($middleRandom % 10);
            // 前方固定部の最後の数字を変数に格納
            $prefixLast = substr($prefix, -1);
            // $prefixLast = $prefix[strlen($prefix) - 1];
            // 後方固定部の最初の数字を変数に格納
            $suffixFirst = substr($suffix, 0, 1);
            /* 
                生成された中間乱数の最初の数字と前方固定部の最後の数字が同じ、
                または生成された中間乱数の最後の数字と後方固定部の最初の数字が同じなら
                処理を最初からやり直す
            */
            if($middleRandomFirst === $prefixLast || $middleRandomLast === $suffixFirst) {
                goto fixed_generate;
            }
            // 生成された中間乱数を文字列型に変換
            $middleRandomStr = (string)$middleRandom;
            $middleRandomArray = [];
            /*
                文字列型に変換した中間乱数を一文字ずつ$middleRandomArrayの中に存在するかどうか調べ、
                なければ$middleRandomArrayに追加、あれば処理を最初からやり直す
                これによってまずは中間乱数だけを指定個数分生成した配列が出来上がる
            */
            for($j = 0; $j < $digit; $j++) {
                if(!in_array(substr($middleRandomStr, $j, 1), $middleRandomArray, true)) {
                    $middleRandomArray[] = substr($middleRandomStr, $j, 1);
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
                次に、explode()を用いて","で先ほどの処理結果を区切って一要素とし、$exclusionArrayに配列として格納する
            */
            $exclusionArray = explode(",", wordwrap($exclusion, 1, ",", true));
            /*
                中間乱数(XXX)の桁数分ループを回し、中間乱数を一文字ずつ$exclusionArrayの中に存在するか調べ、
                なければ追加、あれば処理を最初からやり直す
            */
            for($j = 0; $j < $digit; $j++) {
                if(!in_array(substr($middleRandomStr, $j, 1), $exclusionArray, true)) {
                    $exclusionArray[] = substr($middleRandomStr, $j, 1);
                } else {
                    goto fixed_generate;
                }
            }
            // 前方固定+中間乱数+後方固定の形に結合させる
            $combinedRandomStr = (string)$prefix . $middleRandomStr . (string)$suffix;
            // 文字列型だった乱数を整数型に変換
            $combinedRandom = (int)$combinedRandomStr;
            // 乱数が$numberArrayの中に存在するか調べ、なければ追加する
            if(!in_array($combinedRandom, $numberArray, true)) {
                // 配列に$middleRandomを追加する
                $numberArray[] = $combinedRandom;
                $i++;
            }
            
        } while($i < $count);
        
        sort($numberArray, SORT_ASC);
        
        return $numberArray;
    }

}