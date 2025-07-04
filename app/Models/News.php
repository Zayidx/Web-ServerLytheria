<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'category_id', 'owner_id', 'image_url', 'image_caption', 'content', 'status', 'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected static function boot() {
        parent::boot();
        static::saving(function ($news) {
            $news->slug = Str::slug($news->title);
            if ($news->status == 'published' && is_null($news->published_at)) {
                $news->published_at = now();
            }
        });
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function owner() {
        return $this->belongsTo(Owner::class);
    }
}
