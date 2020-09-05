@extends('layouts.followers')
@section('title', 'フォロワー一覧')
@section('content')
    <div class="container">
        <div class="row">
            <div id="gbl_title_container" class="clearfix">  
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
                                        {{ $user_info->name }}
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
                                            <a href="/user/favorite/" rel="nofollow">
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
                        <div id="content">
                            <div id="user_list_2column">
                                <ul class="clearfix">
                                    <?php
                                      $i = 0;
                                    ?>
                                        @foreach($users as $user)
                                             @if($user->id != $show_id)
                                                <li class="list">
                                                    <div class="container">
                                                        <div class="main clearfix">
                                                            <div class="img_box">
                                                                <p class="img">
                                                                    @if($user->thumbnail)
                                                                       <img src="{{ asset('/storage/thumbnail/'. $user->thumbnail) }}" class="thumbnail">
                                                                    @else
                                                                       <img src="//cdn.wimg.jp/content/no_image/profile/nu_200.gif" srcset="//cdn.wimg.jp/content/no_image/profile/nu_640.gif 2x">
                                                                    @endif
                                                                </p>
                                                            </div>
                                                            <div class="content">
                                                                <h3 class="name">
                                                                    <a href="{{ url('/user/profile/mypages?id='. $user->id) }}">
                                                                        {{ $user->name }}
                                                                    </a>
                                                                </h3>
                                                                <ul class="meta clearfix">
                                                                    <li>
                                                                        <a href="{{ url('/user/profile/mypages?id='. $user_info->id) }}">
                                                                            {{ $cntFolloweePost[$i] }}
                                                                            <span>コーディネート</span>
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ route('followers', ['id' => $user_info->id]) }}" >
                                                                            {{ $cntFolloweeFollowees[$i] }}
                                                                            <span>フォロワー</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="sub btn_block">
                                        					<div class="btn2_follow">
                                                                <div class="btn_follow">
                                                                    @if ($is_following)
                                                                     
                                                                    @else
                                                                    <div>
                                                                        <a href="{{ action('User\FollowController@destroy', ['id' => $user_info->id]) }}" class="over" >
                                                                            <button type="submit" class="btn btn-danger">フォロー中</button>
                                                                        </a>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                        				               </div>
                                                    </div>    
                                                </li>
                                            @endif    
                                        @endforeach    
                                    <?php
                                       $i++;
                                     ?>    
                                </ul>
                            </div>
                        </div>
                    </div>
            </div>    
        </div>
    </div>
@endsection