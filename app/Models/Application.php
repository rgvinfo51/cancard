<?php

namespace App\Models;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
     use Sluggable;
    protected $fillable = [
        'applicationname',
        'slug',
        'applicationinfo',
        'banner',
        'banneralttext',
        'description',
        'metatitle',
        'metakeywords',
        'metadescription',
        'status'
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
