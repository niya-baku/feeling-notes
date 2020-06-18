<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Column extends Model
{
    /** JSONに含める属性 */
    protected $visible = [
        'id', 'situation', 'feeling','think','another_think','another_feeling',
    ];

    protected $perPage = 6;

    /**
     * リレーションシップ - usersテーブル
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id', 'users');
    }
}
