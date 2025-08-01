<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory;
    use Sluggable;
    protected $fillable = ['title', 'description', 'slug'];

    public function sluggable():array{
        return [
            'slug'=>
            [
                'source'=>'title'
            ]
            ];
    }
}