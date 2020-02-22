@extends('layouts.app')

@section('content')
    <h2>Reservation page</h2>
    <hr>
    <form action="{{route('student.store')}}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">RESERVE</button>
        <a href="/student" class="btn btn-secondary">Back</a>
    </form>
@endsection