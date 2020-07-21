{{-- layouts/top.blade.phpを読み込む --}}
@extends('layouts.top')

{{-- toppages.blade.phpの@yield('title')に'トップページ'を埋め込む --}}
@section('title', 'トップページ')

{{-- user.blade.phpの@yield('content')に以下タグを埋め込む --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>トップページ</h2>
            </div>
        </div>
    </div>
@endsection