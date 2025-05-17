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
        'township_id',
        'category_id',
        'media_type',
        'publish_status',
        'file_path', 
        'status',
    ];

     // Designer (User)
    public function designer()
    {
        return $this->belongsTo(User::class, 'designer_id');
    }

    // Township
    public function township()
    {
        return $this->belongsTo(Township::class);
    }

    // Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Media (Optional - if there's a direct relation or one-to-many in future)
   public function media()
{
    return $this->belongsTo(Media::class);
}

}
