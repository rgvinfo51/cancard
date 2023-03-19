<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class POupload extends Model
{
    use HasFactory;
       
    protected $guarded = [];
    protected $table = 'po_upload';
}
