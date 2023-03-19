<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
   use Sluggable;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'shortdescription',
        'categoryimage',
        'banner',
        'categoryimagealttext',
        'banneralttext',
        'parentid',
        'applications',
        'sortorder',
        'metatitle',
        'metakeywords',
        'metadescription',
        'status',
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
