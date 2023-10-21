@extends('layout')

@section('content')
    <div class="row container" id="wrapper">
        <div class="halim-panel-filter">
            <div id="ajax-filter" class="panel-collapse collapse" aria-expanded="true" role="menu">
                <div class="ajax"></div>
            </div>
        </div>
        <div id="halim_related_movies-2xx" class="wrap-slider">
            <div class="section-bar clearfix">
                <h3 class="section-title"><span>CÓ THỂ BẠN MUỐN XEM</span></h3>
            </div>
            <div id="halim_related_movies-2" class="owl-carousel owl-theme related-film">
                @foreach ($phimhots as $phimhot)
                    <article class="thumb grid-item post-38498">
                        <div class="halim-item">
                            <a class="halim-thumb" href="{{ route('movie',$phimhot->slug) }}" title="{{ $phimhot->title }}">
                                <figure><img class="lazy img-responsive"
                                        src="{{ asset('uploads/movie/'.$phimhot->image)  }}"
                                        alt="{{ $phimhot->title }}" title="{{ $phimhot->title }}"></figure>
                                <span class="status">@if ($phimhot->resolution == 0) HD @else FullHD @endif</span><span class="episode"><i class="fa fa-play"
                                        aria-hidden="true"></i>Vietsub</span>
                                <div class="icon_overlay"></div>
                                <div class="halim-post-title-box">
                                    <div class="halim-post-title ">
                                        <p class="entry-title">{{ $phimhot->title }}</p>
                                        <p class="original_title">{{ $phimhot->title }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
            <script>
                jQuery(document).ready(function($) {
                    var owl = $('#halim_related_movies-2');
                    owl.owlCarousel({
                        loop: true,
                        margin: 4,
                        autoplay: true,
                        autoplayTimeout: 4000,
                        autoplayHoverPause: true,
                        nav: true,
                        navText: ['<i class="fa-solid fa-caret-left"></i>',
                            '<i class="fa-solid fa-angle-right"></i>'
                        ],
                        responsiveClass: true,
                        responsive: {
                            0: {
                                items: 2
                            },
                            480: {
                                items: 3
                            },
                            600: {
                                items: 4
                            },
                            1000: {
                                items: 5
                            }
                        }
                    })
                });
            </script>
        </div>
        <main id="main-contents" class="col-xs-12 col-sm-12 col-md-8">
            @foreach ($category as $cate_home)
                <section id="halim-advanced-widget-2">
                    <div class="section-heading">
                        <a href="{{ route('category',$cate_home->slug) }}" title="{{ $cate_home->title }}">
                            <span class="h-text">{{ $cate_home->title }}</span>
                        </a>
                    </div>

                    <div id="halim-advanced-widget-2-ajax-box" class="halim_box">
                        @foreach ($cate_home->movie->take(12) as $item)
                            <article class="col-md-3 col-sm-3 col-xs-6 thumb grid-item post-37606">
                                <div class="halim-item">
                                    <a class="halim-thumb" href="{{ route('movie',$item->slug) }}">
                                        <figure><img class="lazy img-responsive"
                                                src="{{ asset('uploads/movie/' . $item->image) }}" alt="{{ $item->title }}"
                                                title="{{ $item->title }}"></figure>
                                        <span class="status">TẬP 15</span><span class="episode"><i class="fa fa-play"
                                                aria-hidden="true"></i>Vietsub</span>
                                        <div class="icon_overlay"></div>
                                        <div class="halim-post-title-box">
                                            <div class="halim-post-title ">
                                                <p class="entry-title">{{ $item->title }}</p>
                                                <p class="original_title">{{ $item->title }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </article>
                        @endforeach


                    </div>
                </section>
            @endforeach

        </main>
        @include('include.sidebar')
    </div>
@endsection
