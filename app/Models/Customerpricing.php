<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customerpricing extends Model
{
    use HasFactory;
   // use Sluggable;
       
    protected $guarded = [];
    protected $table = 'customerprice';
    public function sluggable()
    {
        /*return [
            'slug' => [
                'source' => 'title'
            ]
        ];*/
    }
}
