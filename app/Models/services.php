<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class services extends Model
{
    protected $fillable = [
        'nom',
        'description',
        'categorie',
        'prix',
        'durer',

    ];
}
