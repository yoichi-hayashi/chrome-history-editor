<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\HistoryLogSearchService;

class HistoryLogController extends Controller
{
    public function index()
    {
        return view('logform');
    }
    
    public function store(Request $request)
    {
        $request->user()->historylogs()->create([
            'log_name' => $request->log_name,
            'log_content' => $request->log_content,
            'content_time' => $request->content_time,
        ]);

        return view('logform');
    }
    
    public function search(Request $request)
    {
        $result = HistoryLogSearchService::search($request);
        
        return view('logform', [
            'logs' => $result
        ]);
    }
    
    public function destroy($id)
    {
        $historylog = \App\HistoryLog::findOrFail($id);
        
        if (\Auth::id() === $historylog->user_id) {
            $historylog->delete();
        }
        
        return back();
    }
}
