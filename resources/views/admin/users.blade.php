@extends('layouts.app')
@section('title', 'Students')
@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Active Students</h4>
    </div>
    <ul class="list-group">
        @foreach ($actives as $active)
        <li class="list-group-item"> {{ $active->name }} </li>
        @endforeach
    </ul>
</div>
<br>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Inactive Students</h4>
    </div>
    <ul class="list-group">
        @foreach ($inactives as $inactive)
        <li class="list-group-item"> {{ $inactive->name }} </li>
        @endforeach
    </ul>
</div>
<br>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Moderators</h4>
    </div>
    <ul class="list-group">
        @foreach ($moderators as $moderator)
        <li class="list-group-item"> {{ $moderator->name }} </li>
        @endforeach
    </ul>
</div>
@endsection
