@extends('layouts.app')
@section('title', 'Add User')
@section('content')
@include('admin.partials.errors')
{{-- session()->has , ->get --}}
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Add User</h4>
    </div>
    <ul class="list-group">
        <li class="list-group-item">
            <form action=" {{ route('admin.store-user') }} " method="post">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="username" id="username" placeholder="Username"
                        value="{{old('username')}}">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email"
                        value="{{old('email')}}">
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" name="room_number" id="room_number"
                        placeholder="Room Number" value="{{old('room_number')}}">
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <select class="form-control" name="role" id="role">
                            <option value="student">Student</option>
                            <option value="moderator">Moderator</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="activated" id="activated"
                                    value="activated">
                                Activated
                            </label>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Add User</button>
                </div>
            </form>
        </li>
    </ul>
</div>
@endsection
