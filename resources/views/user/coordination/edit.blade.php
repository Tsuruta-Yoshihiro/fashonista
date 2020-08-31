@extends('layouts.post')
@section('title', '投稿編集')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>投稿編集</h2>
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
                                                   <p class="img">
                                                     <img src="{{ asset('/storage/image/'. $coordination_form->image_path) }}" class="img" width="276" height="368">
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
                                                    <textarea name="coordination_summary" id="coordination_summary">{{ $coordination_form->coordination_summary }}</textarea>
                                                  </div>
                                             </div>
                                        </div>
                                   </section>
                                     <div class="post_delete">
                                       <input type="submit" class="btn btn-primary" value="削除する">
                                     </div>
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