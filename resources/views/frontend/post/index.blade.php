@extends("frontend.master")

@section("title", $post->title." - ".config('app.sitesettings')::first()->site_title)

@section("content")
<section class="post-single">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-12">
                <div class="post-single-image">
                    <img src="{{ asset("uploads/post/".$post->thumbnail) }}" alt="{{ $post->title }}"/>
                </div>
                <div class="post-single-body">
                    <div class="post-single-title">
                        <h1>{{ $post->title }}</h1>
                        <ul class="entry-meta">
                            <li class="post-author-img"><img src="{{ asset("uploads/author/".($post->user->profile ?? "default.webp")) }}" alt="{{ $post->user->name }}"/></li>
                            <li class="post-author"> <a href="{{ route("frontend.user", $post->user->username) }}">{{ $post->user->name }}</a></li>
                            <li class="entry-cat"> <a href="{{ route("frontend.category", $post->category->slug) }}" class="category-style-1 "><span class="line"></span>{{ $post->category->title }}</a></li>
                            <li class="post-date"> <span class="line"></span>{{ $post->created_at->translatedFormat('d \d\e F \d\e Y') }}</li>
                        </ul>
                    </div>
                    <div class="post-single-content">
                        {!! $post->content !!}
                    </div>
                    <div class="post-single-bottom">
                        @if ($post->tags_count > 0)
                        <div class="tags">
                            <p>Etiquetas:</p>
                            <ul class="list-inline">
                                @foreach ($post->tags as $tag)
                                <li>
                                    <a href="{{ route("frontend.tag", $str::slug($tag->name)) }}">{{ $tag->name }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="social-media">
                            <p>Compartir en :</p>
                            <ul class="list-inline">
                                <li>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank"><i class="fab fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/shareArticle?url={{ urlencode(request()->url()) }}&title={{ urlencode($post->title) }}" target="_blank"><i class="fab fa-linkedin"></i></a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($post->title) }}" target="_blank"><i class="fab fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(request()->url()) }}&media={{ urlencode(asset('uploads/post/'.$post->thumbnail)) }}&description={{ urlencode($post->title) }}" target="_blank"><i class="fab fa-pinterest"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    @include("frontend.post.inc.author")
                    @include("frontend.post.inc.comment")
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
