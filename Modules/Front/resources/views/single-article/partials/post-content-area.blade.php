<div class="post-content-area">
    @if($article->hasVideo())
        <div class="post-media post-video" style="position:relative; padding-bottom:56.25%; height:0; overflow:hidden; margin-bottom:1.5rem;">
            <iframe src="{{ $article->embedVideoUrl() }}"
                    style="position:absolute; top:0; left:0; width:100%; height:100%; border:0;"
                    loading="lazy"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerpolicy="strict-origin-when-cross-origin"
                    allowfullscreen>
            </iframe>
        </div>
    @else
        <div class="post-media post-featured-image">
            <a href="{{ asset('storage/' . $article->image->file_path) }}" class="gallery-popup">
                <img src="{{ asset('storage/' . $article->image->file_path) }}" class="img-responsive" alt="{{ $article->image->alt_text }}" style="max-height: 60rem; min-height: 10rem">
            </a>
        </div>
    @endif
    <div class="entry-content">
        {!! $article->body !!}
    </div><!-- Entry content end -->
    @include('front::single-article.partials.tags-area')

    @include('front::single-article.partials.share-items')
</div><!-- Post content end -->
