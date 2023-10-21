<?php

namespace App\Http\Services\Index;

use App\Models\Category;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\Country;
use DB;

class IndexService
{
    public function getCategory()
    {
        return Category::orderBy('position')
        ->with('movie')
        ->where('status',1)
        ->get();
    }

    public function getGenre()
    {
        return Genre::orderBy('id','DESC')
        ->where('status',1)
        ->get();

    }
 
    public function getCountry()
    {
        return Country::orderBy('id','DESC')
        ->where('status',1)
        ->get();
    }

    public function getCateSlug($slug)
    {
        return Category::where('slug',$slug)->first();
    }

    public function getCountSlug($slug)
    {
        return Country::where('slug',$slug)->first();
    }

    public function getGenreSlug($slug)
    {
        return Genre::where('slug',$slug)->first();
    }

    public function getPhimHot()
    {
        return Movie::where('phim_hot',1)->where('status',1)->get();
    }

    public function getMovieCate($cate_slug)
    {
        return Movie::where('category_id',$cate_slug->id)
                    ->where('status',1)
                    ->paginate(5);

    }

    public function getMovieCount($count_slug)
    {
        return Movie::where('country_id',$count_slug->id)
                    ->where('status',1)
                    ->paginate(5);
    }

    public function getMovieGenre($genre_slug)
    {
        return Movie::where('genre_id',$genre_slug->id)
                    ->where('status',1)
                    ->paginate(20);
    }

    public function getMovie($slug)
    {
        return Movie::where('slug',$slug)->first();
    }

    public function getRelated($movie,$slug)
    {
        return Movie::with('category')->where('category_id',$movie->category->id)
                ->orderBy(DB::raw('RAND()'))
                ->whereNotIn('slug',[$slug])->get();
    }

    public function getPhimHotSideBar()
    {
        return Movie::where('status',1)->where('phim_hot',1)->take('15')->get();
    }

    public function getSearch($title)
    {
        return Movie::where('title','LIKE','%'.$title.'%')->paginate(20);
    }
}
