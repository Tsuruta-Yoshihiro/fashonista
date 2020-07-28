@extends('layouts.mypages')

@section('content')

    @include('users.users',['users'=>$users])
  
@endsection