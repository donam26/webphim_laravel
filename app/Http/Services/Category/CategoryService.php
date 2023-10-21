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
                'status'=> $request->input('status'),
                'slug'=> $request->input('slug')
            ]);
            return session()->flash('status', 'Thêm thành công');
        } catch (\Throwable $th) {
            session()->flash('status', $th->getMessage());
            return false;
        }

    }

    public function getCategory()
    {
        return Category::select('id','title','description','status','slug')
                    ->where('status',1)
                    ->orderBy('position','ASC')
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
            'slug' => $request->input('slug'),
        ]);
    }

    public function resorting($request)
    {
        $data = $request->all();
        foreach($data['array_id'] as $key => $value) {
            return Category::where('id',$value)->update([
                'position' => $key
            ]);
        }
    }

}
