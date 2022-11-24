<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postcard extends Model
{
    #use HasFactory;
    
    
    protected $table = 'postcard';

    protected $fillable = [
        'holiday',
        'img',
        'description',
        'type_holiday',
        'text',
        'from_id',
        'to_id',
    ];
    
    public $timestamps = false;
}
