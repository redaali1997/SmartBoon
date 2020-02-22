@extends('layouts.app')

@section('content')
    <h1>Student info.</h1>
    <ul class="group-list">
        <li class="group-list-item"><h2><i>Name:</i> {{$user->name}}</h2></li>
        <li class="group-list-item"><h3><i>Email:</i> {{$user->email}}</h3></li>
        <li class="group-list-item"><h3><i>Boon Number:</i> {{$user->boon_number}}</h3></li>
    </ul>
    <a href="/student" class="btn btn-secondary">Back</a>
    <form action="{{route('student.destroy')}}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" style="float:right;">CANCEL RESERVATION</button>
    </form>
@endsection