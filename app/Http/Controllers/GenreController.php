<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Genre\GenreService;

class GenreController extends Controller
{
    public function __construct(GenreService $genreService)
    {
        $this->genreService = $genreService;
    }
    public function index()
    {

    }

    public function create()
    {
        $title = 'Thể Loại';
        $lists = $this->genreService->getGenre();
        return view('admincp.genre.form',compact('title','lists'));
    }

    public function store(Request $request)
    {
        $this->genreService->store($request);
        return redirect()->back();
    }

    public function show($id)
    {
    }
    
    public function edit($id)
    {
        $genre = $this->genreService->getId($id);
        $lists = $this->genreService->getGenre();
        return view('admincp.genre.form',compact('lists','genre'));
    }

    public function update(Request $request, $id)
    {
        $this->genreService->update($request, $id);
        return redirect()->back();
    }

    public function destroy($id)
    {
        $this->genreService->delete($id);
        return redirect()->back();
    }

    
}
