<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;
    //use Sluggable;
    public $timestamps = true;   
    protected $guarded = [];
    protected $table = 'quotes';
    
}
