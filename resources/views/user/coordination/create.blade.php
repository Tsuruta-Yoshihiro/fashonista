{{-- layouts/post.blade.phpを読み込む --}}
@extends('layouts.post')

{{-- post.blade.phpの@yield('title')に'コーディネート投稿'を埋め込む --}}
@section('title', 'Fashonista')

{{-- post.blade.phpの@yield('content')に以下タグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>コーディネート投稿</h2>
                   <div id="gbl_body" class="clearfix">
                       <div id="content">
                           <form action="{{ action('User\CoordinationController@create') }}" method="post" enctype="multipart/form-data">
                               @if (count($errors) > 0)
                                   <ul>
                                      @foreach($errors->all() as $e)
                                          <li>{{ $e }}</li>
                                      @endforeach
                                   </ul>
                               @endif
                               <!-- 画像アップデート -->
                               <div id="upload_container">
                                   <section id="upload_img" class="clearfix" for="image">
                                       <div class="section_sub required">
                                           <h2>コーディネート画像</h2>
                                       </div>
                                       <div class="section_main clearfix">
                                           <div class="sub">
                                               
                                               <!--jquery読み込み[ #img_box ]、画像表示-->
                                               <div id="img_box" class="img_box">
                                                   <p class="img">
                                                     <img src(unknown) alt width="276" height="368">
                                                   </p>
                                                   <p class="loading">
                                                       <span>Loading...</span>
                                                   </p>
                                               </div>
                                           </div>
                                           <div class="main">
                                               
                                               <p class="select over">
                                                   <input type="file" class="form-control-file" id="file" name="image">
                                                   <span class="txt">写真をアップロード</span>
                                               </p>
                                               <p class="notes">
                                                   推奨サイズ：横500px × 縦：667px
                                                   <br>
                                                   容量：10MB以内
                                               </p>
                                           </div>
                                       </div>
                                   </section>
                                    　 <!-- コーディネート紹介 -->
                                       <section id="coordination_detail" class="clearfix">
                                           <div class="section_sub">
                                               <h2>コーディネート詳細</h2>
                                           </div>
                                           <div class="section_main clearfix">
                                                <div class="list summary">
                                                    <h3>コーディネート紹介文</h3>
                                                     <div class="detail">
                                                        <textarea name="coordination_summary" id="coordination_summary"></textarea>
                                                      </div>
                                                 </div>
                                            </div>           
                                       </section>
                                   </div>
                               </div>
                               {{ csrf_field() }}
                               <div id="processing">
                                   <ul class="clearfix">
                                       <il class="upload">
                                         <input type="submit" class="btn btn-primary" value="投稿する">
                                       </il>
                                   </ul>
                               </div>
                           </form>
                       </div>
                   </div>
            </div>
        </div>
    </div>
@endsection