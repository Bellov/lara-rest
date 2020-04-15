<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $fillable = [
        'title', 'description', 'body','publish_date','created_at'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
