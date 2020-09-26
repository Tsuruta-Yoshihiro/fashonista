@extends('layouts.top')
@section('title', 'Fashonista')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
    　　　　@if (count($errors) > 0)
                <ul>
                    @foreach($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            @endif
            
            <div id="content">
                <form action="{{ action('User\CoordinationController@top') }}" method="get">
                    
                    <!-- ここからユーザー登録している全ユーザーの投稿を最新投稿順に8件表示する -->
                    <h2>最新投稿</h2>
                    <div id="posts_list">
                        <ul class="list clearfix">
                            @foreach($new_posts as $post)
                                <li class="private">
                                    <div class="imagelist">
                                        <a href="{{ url('/user/coordination/show?id=' . $post->user_id . "&post_id=" . $post->id) }}">
                                            <img src="{{ secure_asset('storage/image/' . $post->image_path) }}"></img>
                                        </a> 
                                    </div>     
                                    <div class="meta clearfix">
                                        <div class="card-body pt-0 pb-2 pl-1">
                                            <div class="like_icon">
                                                <post-like
                                                  :initial-is-liked-by='@json($post->isLikedBy(Auth::user()))'
                                                  :initial-likes-count='@json($post->likescount)'
                                                  :authorized='@json(Auth::check())'
                                                  endpoint="{{ route('like', ['post' => $post]) }}"
                                                   
                                                >
                                                 </post-like>
                                            </div>
                                        </div>
                                    </div>     
                                </li>
                            @endforeach    
                        </ul>
                    </div>
                    
                    <!-- ここからユーザー登録している全ユーザーの投稿をランダムで8件表示する -->
                    <h2>投稿の紹介</h2>
                    <div id="posts_list">
                        <ul class="list clearfix">
                            @foreach($rand_posts as $post)
                                <li class="private">
                                    <div class="imagelist">
                                        <a href="{{ url('/user/coordination/show?id=' . $post->user_id . "&post_id=" . $post->id) }}">
                                            <img src="{{ secure_asset('storage/image/' . $post->image_path) }}"></img>
                                        </a>
                                    </div>     
                                    <div class="meta clearfix">
                                        <div class="card-body pt-0 pb-2 pl-1">
                                            <div class="like_icon">
                                                <post-like
                                                  :initial-is-liked-by='@json($post->isLikedBy(Auth::user()))'
                                                  :initial-likes-count='@json($post->likescount)'
                                                  :authorized='@json(Auth::check())'
                                                  endpoint="{{ route('like', ['post' => $post]) }}"
                                                >
                                                 </post-like>
                                            </div>
                                        </div>
                                    </div>     
                                </li>
                            @endforeach    
                        </ul>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection