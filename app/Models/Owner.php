<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model {
    use HasFactory;
    protected $fillable = ['name', 'job', 'quote', 'profile_image_url', 'skin_image_url', 'head_skin_image_url'];
}
