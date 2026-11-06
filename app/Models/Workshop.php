<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'date_str',
        'instructor',
        'instructor_avatar',
        'topic',
        'price',
        'description',
        'link',
    ];
}
