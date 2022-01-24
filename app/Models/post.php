<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    public $timestamps = false;
    protected $table = 'post';
    use HasFactory;

    protected $fillable = [
        'id ',
        'title',
        'body'
    ];
}
