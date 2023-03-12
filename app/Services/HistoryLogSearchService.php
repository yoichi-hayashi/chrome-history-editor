<?php
namespace App\Services;
use Illuminate\Http\Request;

class HistoryLogSearchService
{
    public static function search(Request $request)
    {
        $logName = $request->name_explore;
        $minTime = $request->from_date;
        $maxTime = $request->until_date;
        $result = [];
        if($request->filled('name_explore')) {
            if($request->filled('from_date') && $request->filled('until_date')) {
                $result = $request->user()->historylogs()->where('log_name', 'like', "%{$logName}%")
                    ->WhereBetween('content_time', [$minTime, $maxTime])->get();
            } else {
                if($request->filled('from_date')) {
                    $result = $request->user()->historylogs()->where('log_name', 'like', "%{$logName}%")
                        ->where('content_time', '>=', $minTime)->get();
                } else if($request->filled('until_date')) {
                    $result = $request->user()->historylogs()->where('log_name', 'like', "%{$logName}%")
                        ->where('content_time', '<=', $maxTime)->get();
                } else {
                    $result = $request->user()->historylogs()->where('log_name', 'like', "%{$logName}%")->get();
                }
            }
        } else {
            if($request->filled('from_date') && $request->filled('until_date')) {
                $result = $request->user()->historylogs()
                    ->WhereBetween('content_time', [$minTime, $maxTime])->get();
            } else {
                if($request->filled('from_date')) {
                    $result = $request->user()->historylogs()
                        ->where('content_time', '>=', $minTime)->get();
                } else if($request->filled('until_date')) {
                    $result = $request->user()->historylogs()
                        ->where('content_time', '<=', $maxTime)->get();
                }
            }
        }
        
        return $result;
    }
}