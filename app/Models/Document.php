<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
    ];

    public function comments() {
        return $this->morphMany('comments', 'commentable');
    }

    public function user() {
        return $this->belongsTo('users');
    }
}
