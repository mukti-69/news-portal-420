<nav class="post-navigation clearfix" style="display: flex">
    <div class="post-previous">
        @if($previous_article)
            <a href="{{ $previous_article->getUrl() }}">
                <span><i class="fa fa-angle-right"></i>আগের খবর</span>
                <h3>
                    {{ $previous_article->title }}
                </h3>
            </a>
        @endif
    </div>
    <div class="post-next">
        @if($next_article)
            <a href="{{ $next_article->getUrl() }}">
                <span>পরের খবর <i class="fa fa-angle-left"></i></span>
                <h3>
                    {{ $next_article->title }}
                </h3>
            </a>
        @endif
    </div>
</nav><!-- Post navigation end -->
