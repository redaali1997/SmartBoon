@extends('layouts.app')
@section('title', $user->name)
@section('content')
@include('admin.partials.flash')
@include('admin.partials.errors')
@if ($user->role === 'student')
<a href=" {{ route('admin.students') }} " class="btn btn-primary">Back to students</a>
@else
<a href=" {{ route('admin.moderators') }} " class="btn btn-primary">Back to moderators</a>
@endif
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit: {{ $user->name }}</h4>
    </div>
    <ul class="list-group">
        <li class="list-group-item">
            <form action=" {{ route('admin.update', $user->id) }} " method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Username:</label>
                    <input type="text" name="username" value="{{ $user->name }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                </div>
                @if ($user->role === 'student')
                <div class="form-group">
                    <label for="name">Boon Number:</label>
                    <input type="number" name="boon_number" value="{{ $user->boon_number }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="name">Room Number:</label>
                    <input type="number" name="room_number" value="{{ $user->room_number }}" class="form-control">
                </div>
                @endif
                <button class="btn btn-primary">Update</button>
            </form>
            <br>
            <form action=" {{ route('admin.delete', $user->id) }} " method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">Delete</button>
            </form>
        </li>
    </ul>
</div>
@endsection
