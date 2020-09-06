@extends('layouts.mypages')
@section('title', 'マイページ')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>マイページ</h2>
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
                                <a href="{{ url('/user/profile/edit') }}" class="over">プロフィール変更</a>
                            </p>
                        </div>
                        @else
                        <div class="btn_follow">
                             @if ($is_following)
                             <div>
                                  <a href="{{ action('User\FollowController@destroy', ['id' => $user_info->id]) }}" class="over" >
                                      <button type="submit" class="btn btn-danger">フォロー解除</button>
                                  </a>
                             </div>
                             @else
                             <div>
                                <a href="{{ action('User\FollowController@store', ['id' => $user_info->id]) }}" class="over" >
                                    <button type="submit" class="btn btn-primary">フォローする</button>
                                </a>
                             </div>
                             @endif
                        </div>
                        @endif
                    </div>
                    <div id="user_main">
                        <section class="intro">
                            <h1 class="user_name">
                                <a href="{{ url('/user/profile/mypages?id='. $user_info->id) }}">
                                    @if($auth->id == $show_id)
                                     {{ $auth->name }}
                                    @else
                                     {{ $user_info->name }}
                                    @endif
                                </a>
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
                                        <a href="{{ url('/user/profile/mypages?id='. $user_info->id) }}">
                                            {{ $count_posts }}
                                            <span>コーディネート</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('likes', ['id' => $user_info->id]) }}" >
                                            {{ $count_likes }}
                                            <span>お気に入り</span>
                                        </a> 
                                    </li>
                                </ul>
                            </div>
                            <div class="sub">
                                <ul class="clearfix">
                                    <li>
                                        <a href="{{ route('followers', ['id' => $user_info->id]) }}" >
                                            {{ $count_followers }}
                                            <span>フォロワー</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('followings', ['id' => $user_info->id]) }}" >
                                            {{ $count_followings }}
                                            <span>フォロー</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </div>
                <div id="content">
                    <div class="btnAdd">
                         @if($auth->id == $show_id)
                           <!-- ログインしているユーザー自身であれば投稿ボタン表示する -->
                           <a href=" {{ url('/user/coordination/create') }}" class="over">コーディネートを投稿する</a>
                         @else
                           <!-- ログインしているユーザーではない場合は投稿ボタン表示しない -->
                         @endif
                    </div>
                </div>
                <form action="{{ action('User\ProfileController@mypages') }}" method="get">
                    <div id="main_list">
                         <ul class="list clearfix">
                             @foreach($posts as $post)
                                 <li class="private">
                                     <div class="imagelist">
                                         <a href="{{ url('/user/coordination/show?id='. $post->id) }}">
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
@endsection