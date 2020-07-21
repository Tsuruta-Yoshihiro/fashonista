{{-- layouts/mypages.blade.phpを読み込む --}}
@extends('layouts.mypages')

{{-- mypages.blade.phpの@yield('title')に'マイページ'を埋め込む --}}
@section('title', 'マイページ')

{{-- mypages.blade.phpの@yield('content')に以下タグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>マイページ</h2>
                <form action="{{ action('User\ProfileController@mypages') }}" method="get" enctype="multipart/form-data">
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <div id="user_header" class="clearfix">
                        <div id="user_sub">
                            <div class="thumbnail">
                                <p class="img">
                                    @if($auth->id == $show_id)
                                        @if($auth->thumbnail)
                                          <img src="{{ asset('/storage/thumbnail/'. $auth->thumbnail) }}" class="thumbnail" width="148" height="148">
                                        @else
                                          <img src="//cdn.wimg.jp/content/no_image/profile/nu_200.gif" srcset="//cdn.wimg.jp/content/no_image/profile/nu_640.gif 2x" width="148" height="148">
                                        @endif
                                    @else
                                        @if($user_info->thumbnail)
                                          <img src="{{ asset('/storage/thumbnail/'. $user_info->thumbnail) }}" class="thumbnail" width="148" height="148">
                                        @else
                                          <img src="//cdn.wimg.jp/content/no_image/profile/nu_200.gif" srcset="//cdn.wimg.jp/content/no_image/profile/nu_640.gif 2x" width="148" height="148">
                                        @endif
                                    @endif    
                                </p>
                            </div>
                            
                            
                            @if($auth->id == $show_id)
                            <div class="btn_edit">
                                <p class="btn_profileupdate">
                                    <a href=" {{ url('/user/profile/edit') }}" class="over">プロフィール変更</a>
                                </p>
                            </div>
                            @else
                            <div class="btn_follow">
                                 @if ($is_following)
                                    <form action="{{ route('unfollow', ['id' => $user_info->id]) }}" method="POST">
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger">フォロー解除</button>
                                    </form>
                                 @else
                                    <form action="{{ route('follow', ['id' => $user_info->id]) }}" method="POST">
                                        <button type="submit" class="btn btn-primary">フォローする</button>
                                    </form>
                                 @endif
                            </div>
                            @endif
                        </div>
                        <div id="user_main">
                            <section class="intro">
                               <h1 class="user_name">
                                @if($auth->id == $show_id)
                                 {{ $auth->name }}
                                @else
                                 {{ $user_info->name }}
                                @endif
                                </h1>
                            </section>
                        </div>
                    </div>
                                <div id ="gbl_body" class="clearfix">
                                    <div id="user_menu">
                                        <nav class="clearfix">
                                            <div class="main">
                                                <ul class="clearfix">
                                                    
                                                    <li>
                                                        <a href="/user/" rel="nofollow">
                                                            <span>コーディネート</span>
                                                        </a>
                                                    </li>
                                                    
                                                    <li>
                                                        <a href="/user/favorite/" rel="nofollow">
                                                            <span>お気に入り</span>
                                                        </a> 
                                                    </li>
                                                </ul>
                                            </div>
                                            
                                            <div class="sub">
                                                <ul class="clearfix">
                                                    <li>
                                                        <a href="{{ route('followers', ['id' => $user_info->id]) }}" class="">フォロワー<br>
                                                        <div class="badge badge-secondary">{{ $count_followers }}</div>   
                                                        </a>
                                                    </li>
                                                    
                                                    <li>
                                                        <a href="{{ route('followings', ['id' => $user_info->id]) }}" class="">フォロー中<br>
                                                        <div class="badge badge-secondary">{{ $count_followings }}</div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </nav>
                                    </div>
                                </div>
                                <div id="content">
                                    <div class="btnAdd">
                                         <a href=" {{ url('/user/coordination/create') }}" class="over">コーディネートを投稿する</a>
                                    </div>
                                </div>
                                　　
                                    <form action="{{ action('User\ProfileController@mypages') }}" method="get">
                                        <div id="main_list">
                                             <ul class="list clearfix">
                                                 @foreach($posts as $post)
                                                     <li class="private">
                                                         <div class="imagelist">
                                                             <img src="{{ secure_asset('storage/image/' . $post->image_path) }}"></img>
                                                         </div>     
                                                         <div class="meta clearfix">
                                                             <div class="card-body pt-0 pb-2 pl-1">
                                                                 <div class="like_icon">
                                                                     <post-like
                                                                       :initial-is-liked-by='@json($post->isLikedBy(Auth::user()))'
                                                                       :initial-likes-count='@json($post->likescount)'
                                                                       :authorized='@json(Auth::check())'
                                                                       endpoint="{{ route('posts.like', ['post' => $post]) }}"
                                                                       
                                                                     >
                                                                     </post-like>
                                                                 </span>
                                                             </div>
                                                        </div>
                                                     </li>
                                                 @endforeach
                                             </ul>
                                        </div>
                                    </form>
                        </div>
                </form>
        </div>
    </div>
@endsection