<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $fillable = [
        'title', 'description', 'image', 'seo_title', 'seo_description', 'seo_jsonld'
    ];
}
