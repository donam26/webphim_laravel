<?php

namespace App\Http\Services\Country;

use App\Models\Country;

class CountryService
{
    public function store($request)
    {
        try {
            Country::create([
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

    public function getCountry()
    {
        return Country::select('id', 'title', 'description', 'status','slug')
            ->where('status', 1)
            ->orderByDesc('id')
            ->get();
    }

    public function delete($id)
    {
        return Country::where('id', $id)->delete();
    }

    public function getId($id)
    {
        return Country::find($id);
    }

    public function update($request, $id)
    {
        return Country::where('id', $id)->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
            'slug' => $request->input('slug'),
        ]);
    }

}
