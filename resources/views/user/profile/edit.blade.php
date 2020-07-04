{{-- layouts/edit.blade.phpを読み込む --}}
@extends('layouts.edit')

{{-- edit.blade.phpの@yield('title')に'新規登録ページ'を埋め込む --}}
@section('title', 'プロフィール変更')

{{-- edit.blade.phpの@yield('content')に以下タグを埋め込む --}}
@section('content')

@livewireStyles


    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>プロフィール変更</h2>
                <form action="{{ action('User\ProfileController@create') }}" method="post" enctype="multipart/form-data">
                    
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
                    
                    
                    <!-- パスワードの変更 -->
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="password">{{ __('messages.Password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="password_confirmation">{{ __('messages.Confirm Password') }}</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    
                    
　　　　　　　　　　<!-- 性別の変更 -->
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="gender">性別</label>
                        <div class="col-md-6">
                            <select class="form-control" id="gender" neme="gender">
                                <option value="1">男性</option>
                                <option value="2">女性</option>
                            </select>
                        </div>
                    </div>
                    
                    
                    <!-- 身長の変更 -->
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="height">身長</label>
                        <div class="col-md-6">
                            <select class="form-control" id="height" name="height">
                                <?php
                                for ($i = 140; $i <=210; $i++) {
                                print ('<option value="' . $i. '">' . $i . 'cm</option>');
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    
                    
                    <!-- 生年月日の変更 -->
                    <div class="form-group-row">
                        <label class="col-md-4 col-form-label text-md-right" for="birthday">生年月日</label>
                        <div class="col-md-6" style="float: right;">
                            
                            @livewire('birthday')
                            
                        </div>
                        @livewireScripts
                        
                    </div>
                    
                    
                    <!-- プロフィール画像登録＆変更 -->
                    <div class="form-group row">
                        <form method="post" action="{{ route('user.update') }}" enctype="multipart/form-data">
                            <label class="col-md-4 col-form-label text-md-right" for="thumbnail">プロフィール画像</label>
                                <div class="col-md-6" style="float: right;">
                                    
                                    <!--jquery読み込み[ #thumbnail ]、画像表示-->
                                    <div id="thumbnail" class="thumbnail">
                                        <p class="img">
                                          <img src(unknown) alt width="148" height="148">
                                        </p>
                                        <p class="loading">
                                           <span>Loading...</span>
                                        </p>
                                    </div>
                                    <div class="user_thumbnail">
                                        <p class="select over">
                                          <input type="file" class="form-control-file" id="file" name="image">
                                          <span class="txt">写真をアップロード</span>
                                          
                                          <div class="action-button">
                                             <button type="button" class="cancel" id="modalBackgroundForCoverFile"/>キャンセル</button>
                                          </div>
                                        </p>      
                                    </div> 
                                </div>
                        </form>
                    </div>
                        
                    <div class="btnsubmit">
                        {{ csrf_field() }}
                        <input id="submit_button" type="submit" class="btn btn-primary" value="変更する">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
@endsection