<?php

namespace App\Http\Services\Category;

use App\Models\Category;

class CategoryService
{
    public function store($request)
    {
        try {
            Category::create([
                'title' => $request->input('title'),
                'description'=> $request->input('description'),
                'status'=> $request->input('status')
            ]);
            return session()->flash('status', 'Thêm thành công');
        } catch (\Throwable $th) {
            session()->flash('status', 'Thử lại sau');
            return false;
        }

    }

    public function getCategory()
    {
        return Category::select('id','title','description','status')
                    ->orderByDesc('id')
                    ->get();
    }

    public function delete($id)
    {
        return Category::where('id',$id)->delete();
    }

    public function getId($id)
    {
        return Category::find($id);
    }

    public function update($request, $id)
    {
        return Category::where('id', $id)->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->input('status'),
        ]);
    }


}
