<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

     protected $fillable = [
        'title',
        'description',
        'designer_id',
        'associate_id',
        'township_id',
        'category_id',
        'media_type',
        'publish_status',
        'file_path', 
        'status',
    ];
}
