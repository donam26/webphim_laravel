<?php

namespace App\Http\Services\Movie;

use App\Models\Category;
use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;

class MovieService
{
    public function getMovie()
    {
        return Movie::
            select('id', 'title', 'description', 'slug', 'trailer', 'season', 'status', 'image', 'category_id', 'genre_id', 'country_id', 'phim_hot', 'resolution')
            ->with('category', 'movie_genre', 'country')
            ->orderByDesc('id')
            ->get();
    }

    public function getCount()
    {
        return Country::
            select('id', 'title')
            ->orderByDesc('id')
            ->where('status', 1)->get();
    }

    public function getGenre()
    {
        return Genre::
            select('id', 'title')
            ->orderByDesc('id')
            ->where('status', 1)->get();
    }

    public function getCate()
    {
        return Category::
            select('id', 'title')
            ->orderByDesc('id')
            ->where('status', 1)->get();
    }

    public function store($request)
    {
        try {
            $data = $request->all();
            $movie = new Movie();
            $movie->title = $data['title'];
            $movie->description = $data['description'];
            $movie->slug = $data['slug'];
            $movie->trailer = $data['trailer'];
            $movie->season = $data['season'];
            $movie->status = $data['status'];
            $movie->category_id = $data['category_id'];
            $movie->country_id = $data['country_id'];
            $movie->phim_hot = $data['phim_hot'];
            $movie->resolution = $data['resolution'];
   
            foreach ($data['genre'] as $gen) {
                $movie->genre_id = $gen[0];
            }

            $get_image = $request->file('image');

            if ($get_image) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('uploads/movie', $new_image);
                $movie->image = $new_image;
            }

            $movie->save();
            $movie->movie_genre()->attach($data['genre']);

            return session()->flash('status', 'Thêm thành công');
        } catch (\Throwable $th) {
            session()->flash('status', $th->getMessage());
            return false;
        }

    }

    public function delete($id)
    {
        return Movie::where('id', $id)->delete();
    }

    public function getId($id)
    {
        return Movie::find($id);
    }

    public function update($request, $id)
    {
        $get_image = $request->file('image');
        $image = "";
        foreach ($request->input('genre') as $key) {
            $genre = $key[0];
        }

        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'slug' => $request->input('slug'),
            'trailer' => $request->input('trailer'),
            'season' => $request->input('season'),
            'status' => $request->input('status'),
            'category_id' => $request->input('category_id'),
            'genre_id' => $genre,
            'country_id' => $request->input('country_id'),
            'phim_hot' => $request->input('phim_hot'),
            'resolution' => $request->input('resolution'),
        ];
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 9999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('uploads/movie', $new_image);
            $image = $new_image;
            $data['image'] = $image;

        }
        session()->flash('status', 'Sửa thành công');
        return Movie::where('id', $id)->update($data);
    }

    public function list_genre()
    {
        return Genre::all();
    }
}
