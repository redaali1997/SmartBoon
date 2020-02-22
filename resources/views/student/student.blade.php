@extends('layouts.app')

@section('content')
    <h2>Reservation page</h2>
    <hr>
    @if ($available)
        <form action="{{route('reserve')}}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">RESERVE</button>
        </form>    
    @else
        <form action="{{route('delete', $order->id)}}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">CANCEL RESERVATION</button>
        </form>
    @endif
@endsection