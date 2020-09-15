@extends('layouts.show')
@section('title', '投稿詳細')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>投稿詳細</h2>
                <div id="gbl_body" class="clearfix">
                    <div id="content">
                        <form action="{{ action('User\CoordinationController@show') }}" method="get" enctype="multipart/form-data">
                            @if (count($errors) > 0)
                                <ul>
                                    @foreach($errors->all() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            
                            <!-- クリックした投稿のユーザーの詳細を表示 -->
                          
                            <div id="user_header" class="clearfix">
                                <div id="user_sub">
                                    <div class="thumbnail">
                                        <p class="img">
                                            @if($user_info->thumbnail)
                                              <img src="{{ asset('/storage/thumbnail/'. $user_info->thumbnail) }}" class="thumbnail" width="148" height="148">
                                            @else
                                              <img src="//cdn.wimg.jp/content/no_image/profile/nu_200.gif" srcset="//cdn.wimg.jp/content/no_image/profile/nu_640.gif 2x" width="148" height="148">
                                            @endif
                                        </p>
                                    </div>
                                    @if($auth->id == $show_id)
                                    <div class="btn_edit">
                                        <p class="btn_profileupdate">
                                            <!--  -->
                                            <a href="{{ url('/user/coordination/edit?id='. $post->id) }}" class="over">投稿を編集する</a>
                                            
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
                                                {{ $user_info->name }}
                                            </a>
                                        </h1>
                                    </section>
                                </div>
                            </div>
                          
                            <!-- クリックした投稿画像を表示 -->
                            <div id="gbl_body" class="clearfix">
                                <div id="content_container" class="clearfix">
                                    <div id="content_main">
                                        <div id="coordination_img">
                                            <p class="img">
                                                <img src="{{ asset('/storage/image/'. $post->image_path) }}" width="556" height="742">
                                            </p>
                                        </div>
                                    
                                        <div class="meta clearfix">
                                            <div class="card-body pt-0 pb-0 pl-1">
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
                                        <div class="coordination_summary">
                                            
                                        </div>
                                    </div>    
                                </div>
                            </div>
                           {{ csrf_field() }}
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection