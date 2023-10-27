<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;

    protected $fillable = [
        'meta_title',
        'meta_keywords',
        'post_seo_name',
        'post_title',
    ];

  
}
