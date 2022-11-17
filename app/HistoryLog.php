<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryLog extends Model
{
    protected $fillable = ['user_id', 'log_name', 'log_content', 'content_time'];

    /**
     * この投稿を所有するユーザ。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
