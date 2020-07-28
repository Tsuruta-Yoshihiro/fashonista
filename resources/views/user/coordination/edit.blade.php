{{-- layouts/post.blade.phpを読み込む --}}
@extends('layouts.post')

{{-- upload.blade.phpの@yield('title')に'投稿編集'を埋め込む --}}
@section('title', '投稿編集')

{{-- create.blade.phpの@yield('content')に以下タグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2></h2>
                
                   <div id="gbl_body" class="clearfix">
                       <div id="content">
                           <form action="{{ action('User\CoordinationController@update') }}" method="post" enctype="multipart/form-data">
                               
                               
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
                                                   <p class="img">{{ $coordination_form->image_path }}
                                                     <img src(unknown) alt width="276" height="368">
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
                                   
                                　 <!-- アイテム追加
                                   <div id="secondary">
                                       <section id="upload_item" class="clearfix" name="item">
                                           <div class="section_sub required">
                                               <h2>着用アイテム</h2>
                                           </div>
                                           <div class="section_main clearfix">
                                               <div id="regist_item">
                                                   
                                               </div>
                                               <div id="add_item">
                                                   <div id="add_btn">
                                                       <p class="trigger over">
                                                           <span class="ico">＋</span>
                                                           <span class="txt">アイテムを追加</span>
                                                       </p>
                                                   </div>
                                               
                                               <p class="notes">
                                                   最大６アイテムまで追加できます (残り
                                                   <span class="num">6</span>
                                                   )
                                               </p>
                                               </div>
                                           </div>
                                       </section>
                                       -->
                                       
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
                                         <input type="submit" class="btn btn-primary" value="投稿内容を修正する">
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