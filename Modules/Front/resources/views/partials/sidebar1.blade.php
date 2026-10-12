<div class="{{ $sidebar_classes ?? 'col-xs-12' }}" style="{{ $side_styles ?? 'margin-bottom: 3rem;' }}">
    <div class="sidebar sidebar-right first-sidebar">
        <div class="widget color-default m-bottom-0">
            <h3 class="block-title"><span>সর্বাধিক পঠিত</span></h3>
            @php($topFirst = $first_sidebar['articles_with_most_visits']['first'] ?? null)
            @if(!empty($topFirst))
            <div class="post-overlay-style clearfix">
                <div class="post-thumb">
                    <a
                        href="{{ $topFirst->getUrl() }}">
                        <img class="img-responsive"
                             src="{{ optional($topFirst->image)->url() ?? asset('images/placeholder.png') }}"
                             alt="{{ optional($topFirst->image)->alt_text ?? $topFirst->title }}" style="height: 226px">
                    </a>
                </div>

                <div class="post-content">
                    @if(!empty($topFirst->category))
                    <a class="post-cat"
                       href="{{ route('categories.show', $topFirst->category->slug) }}">
                        {{ $topFirst->category->name }}</a>
                    @endif
                    <h2 class="post-title">
                        <a
                            href="{{ $topFirst->getUrl() }}">
                            {{ $topFirst->title }}</a>
                    </h2>
                    <div class="post-meta">
                        <span class="post-date">{{ front_date_format($topFirst->created_at) }}</span>
                    </div>
                </div><!-- Post content end -->
            </div><!-- Post overlay Article end -->
            @else
            <div class="post-overlay-style clearfix">
                <div class="post-content">
                    <h2 class="post-title">এখনো কোনো আর্টিকেল প্রকাশ হয়নি</h2>
                    <p>অ্যাডমিন প্যানেল থেকে প্রথম নিউজ প্রকাশ করলে এখানে দেখা যাবে।</p>
                </div>
            </div>
            @endif

            <div class="list-post-block">
                <ul class="list-post">
                    @foreach($first_sidebar['articles_with_most_visits']['others'] ?? [] as $article)
                        <li class="clearfix">
                            <div class="post-block-style post-float clearfix">
                                <div class="post-thumb">
                                    <a href="{{ $article->getUrl() }}">
                                        <img class="img-responsive" src="{{ optional($article->image)->url() ?? asset('images/placeholder.png') }}" alt="{{ optional($article->image)->alt_text ?? $article->title }}" style="height: 75px">
                                    </a>
                                    @if(!empty($article->category))
                                    <a class="post-cat" href="{{ route('categories.show', $article->category->slug) }}">{{ $article->category->name }}</a>
                                    @endif
                                </div><!-- Post thumb end -->

                                <div class="post-content">
                                    <h2 class="post-title title-small">
                                        <a href="{{ $article->getUrl() }}">{{ $article->title }}</a>
                                    </h2>
                                    <div class="post-meta">
                                        <span class="post-date">{{ front_date_format($article->created_at) }}</span>
                                    </div>
                                </div><!-- Post content end -->
                            </div><!-- Post block style end -->
                        </li>
                    @endforeach
                </ul><!-- List post end -->
            </div><!-- List post block end -->
        </div><!-- Popular news widget end -->
    </div><!-- Sidebar right end -->
</div><!-- Sidebar Col end -->
