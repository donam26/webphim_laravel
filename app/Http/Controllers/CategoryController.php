<?php

namespace App\Http\Controllers;

use App\Http\Services\Category\CategoryService;
use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{
    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function index()
    {
        $cate = $this->categoryService->getCategory();
        return response()->json($cate);

    }

    public function create()
    {
        $title = 'Danh Mục';
        $lists = $this->categoryService->getCategory();
        return view('admincp.category.form', compact('title', 'lists'));
    }

    public function store(Request $request)
    {
        $this->categoryService->store($request);
        return redirect()->back();
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $category = $this->categoryService->getId($id);
        $lists = $this->categoryService->getCategory();
        return view('admincp.category.form', compact('lists', 'category'));
    }

    public function update(Request $request, $id)
    {
        $this->categoryService->update($request, $id);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->categoryService->delete($id);
        return redirect()->back();
    }

    public function resorting(Request $request)
    {
        $this->categoryService->resorting($request);

    }

    public function createuser(Request $request)
    {
        Category::create([
            'title' => $request->input('title'),
            'description'=> $request->input('description'),
            'status'=> $request->input('status'),
            'slug'=> $request->input('slug'),
            'position'=> "1",
        ]);
    }

}
