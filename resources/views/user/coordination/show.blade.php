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
                                            @if($auth->thumbnail)
                                              <img src="{{ asset('/storage/thumbnail/'. $auth->thumbnail) }}" class="thumbnail">
                                            @else
                                              <img src="//cdn.wimg.jp/content/no_image/profile/nu_200.gif" srcset="//cdn.wimg.jp/content/no_image/profile/nu_640.gif 2x" width="148" height="148">
                                            @endif
                                        </p>
                                    </div>
                                    @if($auth->id == $show_id)
                                    <div class="btn_edit">
                                        <p class="btn_profileupdate">
                                            <a href="{{ url('/user/coordination/edit?id=1') }}" class="over">投稿を編集する</a>
                                            
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
                                                {{ $auth->name }}
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
                                                <img src="{{ asset('/storage/image/'. $coordination_form->image_path) }}" width="556" height="742">
                                            </p>
                                        </div>
                                    </div>
                                    <div id="content_sub">
                                        <div id="action" class="content_bg">
                                            <div id="function_ btn">
                                                <div class="container2 clearfix">
                                                    <div class="card-body pt-0 pb-2 pl-1">
                                                         <div class="like_icon">
                                                             <!-- TODO -->
                                                             <!-- いいねボタン、いいね数の表示 -->
                                                         </div>
                                                    </div>
                                                </div>
                                            </div>
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