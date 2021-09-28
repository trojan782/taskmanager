<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'title',
        'description',
        'category',
        'completed'
    ];

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'userId');
    }
}
