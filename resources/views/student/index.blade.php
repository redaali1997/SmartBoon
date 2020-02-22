@extends('layouts.app')

@section('content')
    <div>
        @if (auth()->user()->role == 'student' && auth()->user()->activated == 0)
        <a href="/student/create" class="btn btn-primary" style="float:right;">Reserve a meal</a>
        @endif
        
        <h1>Students with a reservation</h1>   
        @if (count($users) > 0)
            @foreach ($users as $user)
                @if ($user->role == 'student' && $user->activated)
                    <ul class="group-list">
                        <div class="well">
                            <li class="group-list-item">
                                <h3>
                                    User Name: <a href="/student/{{$user->id}}">{{$user->name}}</a>
                                </h3>
                            </li>
                        </div>
                    </ul>
                @endif
            @endforeach
        @else
            <h3>There are no student reservation.</h3>
        @endif
    </div>
@endsection