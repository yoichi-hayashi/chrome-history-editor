<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryLogController extends Controller
{
    public function index()
    {
        return view('logstore');
    }
    
    public function store(Request $request)
    {
        $request->user()->historylogs()->create([
            'log_name' => $request->log_name,
            'log_content' => $request->log_content,
            'content_time' => $request->content_time,
        ]);

        // 前のURLへリダイレクトさせる
        return back();
    }
    
    public function search(Request $request)
    {
        $logName = $request->name_explore;
        $minTime = $request->from_date;
        $maxTime = $request->until_date;
        $result = $request->user()->historylogs()->where('log_name', 'like', "%{$logName}%")
            ->orWhereBetween('content_time', [$minTime, $maxTime])->get();
        
        return view('logstore', [
            'logs' => $result
        ]);
    }
}
