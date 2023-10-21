<?php

namespace App\Http\Controllers;

use App\Http\Services\Index\IndexService;

class IndexController extends Controller
{
    public function __construct(IndexService $indexService)
    {
        $this->indexService = $indexService;
    }
    public function home()
    {
        $title = "Trang chủ";
        $phimhots = $this->indexService->getPhimHot();
        $phimhot_sidebar = $this->indexService->getPhimHotSideBar();
        $category = $this->indexService->getCategory();
        $genre = $this->indexService->getGenre();
        $country = $this->indexService->getCountry();
        return view('pages.home', compact('title', 'category', 'genre', 'country', 'phimhots', 'phimhot_sidebar'));
    }
    public function category($slug)
    {
        $title = "Danh mục";
        $category = $this->indexService->getCategory();
        $phimhot_sidebar = $this->indexService->getPhimHotSideBar();
        $genre = $this->indexService->getGenre();
        $country = $this->indexService->getCountry();
        $cate_slug = $this->indexService->getCateSlug($slug);
        $movies = $this->indexService->getMovieCate($cate_slug);
        return view('pages.category', compact('title', 'category', 'genre', 'country', 'cate_slug', 'movies', 'phimhot_sidebar'));
    }

    public function genre($slug)
    {
        $title = "Thể loại";
        $phimhot_sidebar = $this->indexService->getPhimHotSideBar();
        $category = $this->indexService->getCategory();
        $genre = $this->indexService->getGenre();
        $country = $this->indexService->getCountry();
        $genre_slug = $this->indexService->getGenreSlug($slug);
        $movies = $this->indexService->getMovieGenre($genre_slug);
        return view('pages.genre', compact('title', 'category', 'genre', 'country', 'genre_slug', 'movies', 'phimhot_sidebar'));
    }

    public function country($slug)
    {
        $title = "Quốc gia";
        $phimhot_sidebar = $this->indexService->getPhimHotSideBar();
        $category = $this->indexService->getCategory();
        $genre = $this->indexService->getGenre();
        $country = $this->indexService->getCountry();
        $count_slug = $this->indexService->getCountSlug($slug);
        $movies = $this->indexService->getMovieCount($count_slug);
        return view('pages.country', compact('title', 'category', 'genre', 'country', 'count_slug', 'movies', 'phimhot_sidebar'));
    }

    public function movie($slug)
    {
        $title = "Phim";
        $category = $this->indexService->getCategory();
        $genre = $this->indexService->getGenre();
        $country = $this->indexService->getCountry();
        $movie = $this->indexService->getMovie($slug);
        $relateds = $this->indexService->getRelated($movie, $slug);
        return view('pages.movie', compact('title', 'category', 'genre', 'country', 'movie', 'relateds'));
    }

    public function watch($slug)
    {
        $title = "Xem phim";
        $movie = $this->indexService->getMovie($slug);
        $relateds = $this->indexService->getRelated($movie, $slug);
        $phimhot_sidebar = $this->indexService->getPhimHotSideBar();
        $category = $this->indexService->getCategory();
        $genre = $this->indexService->getGenre();
        $country = $this->indexService->getCountry();
        $cate_slug = $this->indexService->getCateSlug($slug);
        return view('pages.watch', compact('title', 'category', 'genre', 'country', 'cate_slug', 'phimhot_sidebar', 'relateds'));
    }

    public function episode()
    {
        return view('pages.episode');
    }

    public function timkiem()
    {
        if (isset($_GET['search'])) {
            $title = $_GET['search'];
            $category = $this->indexService->getCategory();
            $phimhot_sidebar = $this->indexService->getPhimHotSideBar();
            $genre = $this->indexService->getGenre();
            $movies = $this->indexService->getSearch($title);
        $country = $this->indexService->getCountry();
            return view('pages.search', compact('title', 'category', 'genre','country', 'phimhot_sidebar','movies'));
        } else {
            return redirect('/');
        }
    }

}
