<?php

namespace App\Http\Services\Genre;

use App\Models\Genre;

class GenreService
{
    public function store($request)
    {
        try {
            Genre::create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'status' => $request->input('status'),
                'slug' => $request->input('slug'),
            ]);
            return session()->flash('status', 'Thêm thành công');
        } catch (\Throwable $th) {
            session()->flash('status', 'Thử lại sau');
            return false;
        }

    }

    public function getGenre()
    {
        return Genre::select('id', 'title', 'description', 'status','slug')
            ->where('status', 1)
            ->orderByDesc('id')
            ->get();
    }

    public function delete($id)
    {
        return Genre::where('id', $id)->delete();
    }

    public function getId($id)
    {
        return Genre::find($id);
    }

    public function update($request, $id)
    {
        return Genre::where('id', $id)->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'slug' => $request->input('slug')
        ]);
    }

}
