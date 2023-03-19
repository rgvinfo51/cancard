<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
   use Sluggable;
   public $timestamps = true;
    protected $fillable = [
        'title',
        'slug',
        'description',
        'bannerimage',
        'bannerimagealttext',
        'metatitle',
        'metakeywords',
        'metadescription',
        'status',
        'created_at'
    ];
    
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
