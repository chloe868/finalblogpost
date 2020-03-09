<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{       
    protected $table = 'comment';
    protected $fillable = [
        'commentcontent',
    ];
    
    protected $hidden = [
        'timestamps',
    ];
    
    public function posts()
    {
        return $this->belongsTo('App\Model\Post');
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    
}