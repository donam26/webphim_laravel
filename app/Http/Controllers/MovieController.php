<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Movie\MovieService;
use App\Models\Movie;
use File;

class MovieController extends Controller
{
    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function index()
    {
        $list = $this->movieService->getMovie();
        $path = public_path()."/json_file/";
        if(!is_dir($path)) {
            mkdir($path,0777,true);
        }
        File::put($path.'movie.json',json_encode($list));
        return "ok";
    }

    public function create()
    {
        $title = "Phim";
        $lists = $this->movieService->getMovie();
        $counts = $this->movieService->getCount();
        $genres = $this->movieService->getGenre();
        $cates = $this->movieService->getCate();
        $list_genre = $this->movieService->list_genre();
        return view('admincp.movie.form',compact('lists','cates','counts','genres','list_genre'));
    }

    public function store(Request $request)
    {
        $this->movieService->store($request);
        return redirect()->back();
    }

    public function show($id)
    {
    }
    
    public function edit($id)
    {
        $movie = $this->movieService->getId($id);
        $lists = $this->movieService->getMovie();
        $cates = $this->movieService->getCate();
        $counts = $this->movieService->getCount();
        $genres = $this->movieService->getGenre();
        $cates = $this->movieService->getCate();
        $list_genre = $this->movieService->list_genre();
        return view('admincp.movie.form',compact('lists','movie','cates','counts','genres','list_genre'));
    }

    public function update(Request $request, $id)
    {
        $this->movieService->update($request, $id);
        return redirect('/movie/create');
    }

    public function destroy($id)
    {
        $this->movieService->delete($id);
        return redirect()->back();
    }
    
    public function update_season(Request $request)
    {
        $data = $request->all();
        $movie = Movie::find($data['id_phim']);
        $movie->season = $data['season'];
        $movie->save();

    }
}
