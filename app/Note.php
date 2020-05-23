<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    
    /** JSONに含める属性 */
    protected $visible = [
        'id', 'record', 'wake_uptime','bedtime','am_image','pm_image','night_image','body',
    ];
    protected $casts = [
        'am_image' => 'integer',
        'pm_image' => 'integer',
        'night_image' => 'integer'
    ];

    /**
     * リレーションシップ - usersテーブル
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id', 'users');
    }
}
