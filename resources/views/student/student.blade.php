@extends('layouts.app')

@section('content')
<div class="jumbotron">
    <h2>Reservation page</h2>
    {{-- <student-order :start="{{(int) $reservingTime->start}}" :end="{{(int) $reservingTime->end}}"
    :reserved="{{$reserved}}"
    :available="{{$available}}" :activated="{{$activated}}"></student-order> --}}
    <h4>From
        {{ (int)$reservingTime->start > 12 ? (int)$reservingTime->start -12 . ' PM' : (int)$reservingTime->start . ' AM' }}
        To
        {{ (int)$reservingTime->end > 12 ? (int)$reservingTime->end -12 . ' PM' : (int)$reservingTime->end . ' AM' }}
    </h4>
    <hr>
    <ul class="list-group">
        <li class="list-group-item">Name: {{ auth()->user()->name }} </li>
        <li class="list-group-item">Email: {{ auth()->user()->email }} </li>
        <li class="list-group-item">Boon Number: {{ auth()->user()->boon_number }} </li>
        <li class="list-group-item">Room Number: {{ auth()->user()->room_number }}</li>
    </ul>
    <hr>
    @if ($activated)
    @if ($available)
    @if ($reserved)
    @if ($notDone)
    <form action="{{route('delete', $order->id)}}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Cancel Reservation</button>
    </form>
    @endif
    @else
    <form action="{{route('reserve')}}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Reserve</button>
    </form>
    @endif
    @else
    <div class="alert alert-info">Reservation time has ended.</div>
    @endif
    @else
    <div class="alert alert-info">Please renew the subscription.</div>
    @endif
</div>

@endsection
