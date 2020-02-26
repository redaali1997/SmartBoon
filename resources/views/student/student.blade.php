@extends('layouts.app')

@section('content')
<h2>Reservation page</h2>
<h4>From
    {{ (int)$reservingTime->start > 12 ? (int)$reservingTime->start -12 . ' PM' : (int)$reservingTime->start . ' AM' }}
    To
    {{ (int)$reservingTime->end > 12 ? (int)$reservingTime->end -12 . ' PM' : (int)$reservingTime->end . ' AM' }}</h4>
<hr>
@if ($reserved)
@if ($available)
<form action="{{route('delete', $order->id)}}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">CANCEL RESERVATION</button>
</form>
@else
<div class="alert alert-info">Reserving time has been ended.</div>
@endif
@else
@if ($available)
<form action="{{route('reserve')}}" method="POST">
    @csrf
    <button type="submit" class="btn btn-primary">RESERVE</button>
</form>
@else
<div class="alert alert-info">Reserving time has been ended.</div>
@endif
@endif
@endsection
