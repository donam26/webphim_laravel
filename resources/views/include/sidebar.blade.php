<aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
    <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
        <div class="section-bar clearfix">
            <div class="section-title">
                <span>Phim Hot</span>
            </div>
        </div>
        <section class="tab-content">
            @foreach ($phimhot_sidebar as $phim)
                <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                    <div class="halim-ajax-popular-post-loading hidden"></div>
                    <div id="halim-ajax-popular-post" class="popular-post">
                        <div class="item post-37176">
                            <a href="chitiet.php" title="{{ $phim->title }}">
                                <div class="item-link">
                                    <img src="{{ asset('uploads/movie/' . $phim->image) }}" class="lazy post-thumb"
                                        alt="{{ $phim->title }}" title="{{ $phim->title }}" />
                                    <span class="is_trailer">
                                        @if ($phim->resolution == 0)
                                            HD
                                        @elseif($phim->resolution == 1)
                                            FullHD
                                        @else
                                            Trailer
                                        @endif
                                    </span>
                                </div>
                                <p class="title">{{ $phim->title }}</p>
                            </a>
                            <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                            <div style="float: left;">
                                <span class="user-rate-image post-large-rate stars-large-vang"
                                    style="display: block;/* width: 100%; */">
                                    <span style="width: 0%"></span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </section>
        <div class="clearfix"></div>
    </div>
</aside>
