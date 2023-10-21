<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;

class Movie extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'slug',
        'trailer',
        'season',
        'status',
        'image',
        'category_id',
        'genre_id',
        'country_id',
        'phim_hot',
        'resolution'
    ];

    public function category() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function genre() {
        return $this->belongsTo(Genre::class, 'genre_id');
    }

    public function country() {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function movie_genre() {
        return $this->belongsToMany(Genre::class, 'movie_genre','movie_id','genre_id');
    }
}
