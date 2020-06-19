{{-- layouts/othermypages.blade.phpを読み込む --}}
@extends('layouts.othermypages')

{{-- othermypages.blade.phpの@yield('title')に'他マイページ'を埋め込む --}}
@section('title', '他マイページ')

{{-- othermypages.blade.phpの@yield('content')に以下タグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2></h2>
                
                  <header id="gbl_title" class="othermypages">
                      <div id="user_header" class="clearfix">
                          <div id="user_sub">
                              <div class="image">
                                  <p class="img">
                                      <img src="###" alt="###" width="148" height="148">
                                  </p>
                              </div>
                              
                              <!-- フォロー機能ボタン -->
                                <div class="btn_follow">
                                    <button type="submit" class="btn btn-primary">フォローする</button>
                                </div>
                             
                        　</div>
                      </div>
                  </header>
                              
                              
                              <div id="gbl_body" class="clearfix">  
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
                                 <div id="main_list">
                                    <ul class="list img_after_load clearfix">
                                        
                                    </ul>
                                 </div>
                            　</div>
                            　  
        　　</div>    
        </div>
    </div>
@endsection    