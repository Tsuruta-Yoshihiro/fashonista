{{-- layouts/profile.blade.phpを読み込む --}}
@extends('layouts.profile')

{{-- profile.blade.phpの@yield('title')に'新規登録ページ'を埋め込む --}}
@section('title', '新規登録ページ')

{{-- profile.blade.phpの@yield('content')に以下タグを埋め込む --}}
@section('content')

@livewireStyles


    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>新規登録ページ</h2>
                <form action="{{ action('User\ProfileController@create') }}" method="post" enctype="multipart/form-data">
                    
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="name">ニックネーム</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="email">{{ __('messages.E-Mail Address') }}</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        </div>
                    </div>
                    
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

                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="gender">性別</label>
                        <div class="col-md-6">
                            <select class="form-control" id="gender" neme="gender">
                                <option value="1">男性</option>
                                <option value="2">女性</option>
                            </select>
                        </div>
                    </div>
                    
                    
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
                
                    
                    <div class="form-group-row">
                        <label class="col-md-4 col-form-label text-md-right" for="birthday">生年月日</label>
                        <div class="col-md-6" style="float: right;">
                            
                            @livewire('birthday')
                            
                        </div>
                        @livewireScripts
                        
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label text-md-right" for="age">年齢</label>
                        <div class="col-md-6">
                            <select class="form-control" id="age" neme="age">
                                <option value="1">表示する</option>
                                <option value="2" selected>表示しない</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="btnsubmit">
                        {{ csrf_field() }}
                        <input id="submit_button" type="submit" class="btn btn-primary" value="登録する">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection