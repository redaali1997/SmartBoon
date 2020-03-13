@extends('layouts.app')
@section('title', $user->name)
@section('content')
@if ($user->role === 'student')
<a href=" {{ route('admin.students') }} " class="btn btn-outline-primary">Back to students</a>
@else
<a href=" {{ route('admin.moderators') }} " class="btn btn-outline-primary">Back to moderators</a>
@endif
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit: {{ $user->name }}</h4>
    </div>
    <ul class="list-group">
        <li class="list-group-item">
            <form action="{{ route('admin.update', $user->id) }}" method="POST">
                @csrf
                @method('PATCH')
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
                <div class="form-group">
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="activated" id="activated"
                                value="activated" {{ $user->activated === 1 ? 'checked' : '' }}>
                            Activated
                        </label>
                    </div>
                </div>
                @endif
                <button class="btn btn-primary" type="submit">Update</button>
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
