{{-- layouts/edit.blade.phpを読み込む --}}
@extends('layouts.edit')

{{-- edit.blade.phpの@yield('title')に'新規登録ページ'を埋め込む --}}
@section('title', 'Fashonista')

{{-- edit.blade.phpの@yield('content')に以下タグを埋め込む --}}
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>プロフィール変更</h2>
                    <form action="{{ action('User\ProfileController@update',$auth->id) }}" method="post" enctype="multipart/form-data">
                    
                            @if (count($errors) > 0)
                                <ul>
                                    @foreach($errors->all() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                            @endif
                            
                            
                            <!-- ニックネームの変更 -->
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="name">ニックネーム</label>
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ $auth->name }}">
                                </div>
                            </div>
                            
                            
                            <!-- メアドの変更 -->
                            <div class="form-group row">
                                <label class="col-md-4 col-form-label text-md-right" for="email">{{ __('messages.E-Mail Address') }}</label>
        
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $auth->email }}" required autocomplete="email">
        
                                </div>
                            </div>
        
                            
                            <!-- プロフィール画像登録＆変更 -->
                            <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right" for="thumbnail">プロフィール画像</label>
                                        <div class="col-md-6" style="float: right;">
                                            
                                               
                                             <div class="sub">
                                                <!--jquery読み込み[ #thumbnail ]、画像表示-->
                                                <div id="thumbnail" class="thumbnail">
                                                    <p class="img">
                                                        <!--<img src(unknown) alt width="148" height="148">-->
                                                    </p>
                                                    @if($auth->thumbnail)
                                                        <img src="{{ asset('/storage/thumbnail/'. $auth->thumbnail) }}" class="thumbnail" width="148" height="148">
                                                    @else
                                                        
                                                        <img src="//cdn.wimg.jp/content/no_image/profile/nu_200.gif" srcset="//cdn.wimg.jp/content/no_image/profile/nu_640.gif 2x" width="148" height="148">
                                                            <p>
                                                               設定なしはデフォルト設定になります。 
                                                            </p>
                                                    @endif
                                                    
                                                </div>
                                             </div>
                                             
                                             <div class="main">
                                                 <p class="select over">
                                                     <input type="file" class="form-control-file" id="file" name="thumbnail">
                                                     
                                                 </p>      
                                             </div> 
                                        </div>
                            </div>
                            
                            {{ csrf_field() }}
                            <div class="btnsubmit">
                                <input id="submit_button" type="submit" class="btn btn-primary" value="変更する">
                            </div>
                    
                    </form>
            </div>
        </div>
    </div>
@endsection