<?php
 
/* function NumberGenerate($frequency){
    for ($i = 0 ; $i < $frequency ; $i++){
        $numbers = mt_rand($fromNum, $toNum);
        $numberContainer[] = $numbers;
    }
}
*/

function NumberGenerate($frequency){
    $i = 0;
        while ($i < $count){
            $generateNum = mt_rand($fromNum, $toNum);
            $numberContainer[] = $generateNum;
            
            if (in_array($generateNum, $numberContainer, true)){
                //配列に$generateNumを追加する
                $numberContainer[] = $generateNum;
            }
        $i++;
    }
}