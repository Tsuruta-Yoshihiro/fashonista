@extends('layouts.top')
@section('title', 'トップページ')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>トップページ</h2>
            　　　　@if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    
                    <div id="content">
                        <section class="pickup_new clearfix">
                            <h2 class="title">週間最新投稿</h2>
                            <ul class="new_list clearfix">
                                 <li class="private">
                                     <div class="imagelist">
                                         <a href="{{ url('/user/coordination/edit') }}">
                                          
                                         </a>
                                     </div>     
                                     <div class="meta clearfix">
                                         <div class="card-body pt-0 pb-2 pl-1">
                                             <div class="like_icon">
                                                
                                             </div>
                                         </div>
                                     </div>   
                                 </li>
                            </ul>
                        </section>
                    </div>
            </div>
        </div>
    </div>
@endsection