<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_title',
        'post_content',
        'post_excerpt',
        'post_date',
        'post_status',
        'img_name',
        'img_path',
        'comment_status'
    ];
}
