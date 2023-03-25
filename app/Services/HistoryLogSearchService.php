<?php
namespace App\Services;
use Illuminate\Http\Request;

class HistoryLogSearchService
{
    public static function search(Request $request)
    {
        $logName = $request->name_search;
        $startDatetime = $request->start_datetime;
        $endDatetime = $request->end_datetime;
        $result = [];
        if($request->filled('name_search')) {
            if($request->filled('start_datetime') && $request->filled('end_datetime')) {
                $result = $request->user()->historylogs()->where('log_name', 'like', "%{$logName}%")
                    ->WhereBetween('content_time', [$startDatetime, $endDatetime])->get();
            } else {
                if($request->filled('start_datetime')) {
                    $result = $request->user()->historylogs()->where('log_name', 'like', "%{$logName}%")
                        ->where('content_time', '>=', $startDatetime)->get();
                } else if($request->filled('end_datetime')) {
                    $result = $request->user()->historylogs()->where('log_name', 'like', "%{$logName}%")
                        ->where('content_time', '<=', $endDatetime)->get();
                } else {
                    $result = $request->user()->historylogs()->where('log_name', 'like', "%{$logName}%")->get();
                }
            }
        } else {
            if($request->filled('start_datetime') && $request->filled('end_datetime')) {
                $result = $request->user()->historylogs()
                    ->WhereBetween('content_time', [$startDatetime, $endDatetime])->get();
            } else {
                if($request->filled('start_datetime')) {
                    $result = $request->user()->historylogs()
                        ->where('content_time', '>=', $startDatetime)->get();
                } else if($request->filled('end_datetime')) {
                    $result = $request->user()->historylogs()
                        ->where('content_time', '<=', $endDatetime)->get();
                }
            }
        }
        
        return $result;
    }
}