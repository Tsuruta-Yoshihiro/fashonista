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
                            <div class="image">
                                <p class="img">
                                    <img src="//cdn.wimg.jp/content/no_image/profile/nu_200.gif" srcset="//cdn.wimg.jp/content/no_image/profile/nu_640.gif 2x" width="148" height="148">
                                </p>
                            </div>
                            <div class="btn_follow">
                                <p class="btn_profileupdate">
                                    <a href=" {{ url('/user/profile/edit') }}" class="over">プロフィール変更</a>
                                </p>
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
                                                        <a href="/user/follower" rel="nofollow">
                                                            <span>フォロワー</span>
                                                        </a>
                                                    </li>
                                                    
                                                    <li>
                                                        <a href="/user/follow/">
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
                                        <a href=" {{ url('/user/coordination/create') }}" class="over">コーディネートを投稿する</a>
                                    </div>
                                </div>
                                    
                                    
                                        <div id="main_list">
                                            <div id ="container_list">
                                                 <form action="{{ action('User\CoordinationController@index') }}" method="get">
                                                　
                                                    <div id ="controls" class="controls"></div> 
                                                        <div class="slideshow-container">
                                                            <div id="loading" class="loader"></div>
                                                                 @foreach($posts as $post)
                                                                     <div>
                                                                          <img src="{{ secure_asset('storage/image/' . $post->image_path) }}">
                                                                     </div>
                                                                 @endforeach
                                                            <div id="slideshow" class="slideshow"></div>
                                                        </div>
                                                    <div id="caption" class="caption-container"></div>
                                                </form>
                                                
                                                <!-- サムネイルナビゲーション -->
                                                <div id="thumbs" class="navigation">
                                                    <ul class="thumbs noscript"></ul>
                                                </div>
                                                <div style="clear:both;"></div>
                                            </div>
                                        </div>
                                    
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection