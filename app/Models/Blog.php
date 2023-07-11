<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'doctor_id', 'blog_title', 'blog_body', 'blog_image'];

    public function user()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }
}
