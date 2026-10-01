<div class="author-box">
    <div class="author-img pull-left">
        <img src="{{ $author->image->url() }}" alt="{{ $author->image->alt_text }}">
    </div>
    <div class="author-info">
        <h3>{{ $author->full_name }}</h3>
        <div class="author-counter pull-right">
            <span>{{ $articlesCount }} খবর</span>
            <span>{{ $commentsCount }} মন্তব্য</span>
        </div>
        <p>{{ $author->bio }}</p>
        @if(!empty($author?->socialNetworks) && $author?->socialNetworks->count() > 0)
            <div class="authors-social" style="clear: both">
                <span>আমাকে অনুসরণ করুন: </span>
                @foreach($author?->socialNetworks as $socialNetwork)
                    <a href="{{ $socialNetwork->url }}" title="{{ $socialNetwork->name }}"><i class="fa fa-{{ $socialNetwork->name }}"></i></a>
                @endforeach
            </div>
        @endif
    </div>
</div> <!-- Author box end -->
