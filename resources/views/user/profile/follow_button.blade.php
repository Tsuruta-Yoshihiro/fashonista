

@if(Auth::check())

    @if (Auth::user()->is_following($user->id))
    
        {!! Form::open(['route' => ['unfollow', $user->id], 'method' => 'delete']) !!}
            {!! Form::submit('フォロー解除') !!}
        {!! Form::close() !!}
        
    @else
    
        {!! Form::open(['route' => ['follow', $user->id]]) !!}
            {!! Form::submit('フォローする') !!}
        {!! Form::close() !!}
        
    @endif
    
@endif
