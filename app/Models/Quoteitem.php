<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quoteitem extends Model
{
    use HasFactory;
    //use Sluggable;
       
    protected $guarded = [];
    protected $table = 'quoteitems';
    
}
