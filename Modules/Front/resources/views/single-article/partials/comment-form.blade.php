<div class="comments-form">
    <h3 class="title-normal">আপনার মন্তব্য লিখুন</h3>

    <form role="form" action="{{ route('comments.store') }}" method="POST">
        @if(session()->has('errors'))
            <div class="alert alert-danger">
                <strong>ত্রুটি!</strong>
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @include('front::single-article.partials.comment-form-inputs')
    </form><!-- Form end -->
</div><!-- Comments form end -->
