<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    use \Conner\Tagging\Taggable;

    protected $fillable = [
        'name',
        'path',
        'user_id',        
    ];

    protected $casts = [
        'publications' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
