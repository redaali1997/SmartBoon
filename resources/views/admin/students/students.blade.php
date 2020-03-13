@extends('layouts.app')
@section('title', 'Students')
@section('content')
@if (request()->query('search'))
<a href=" {{ route('admin.students') }} " class="btn btn-primary">Back To Students</a>
@endif
<form action=" {{ route('admin.students') }} " method="GET">
    <div class="form-group">
        <input type="text" class="form-control" name="search" id="" aria-describedby="helpId"
            placeholder="Search for a student by boon number" value="{{ request()->query('search') }}">
    </div>
</form>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Active Students</h4>
    </div>
    <ul class="list-group">
        {{ $actives->links() }}
        <br>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Boon Number</th>
                    <th>Room Number</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($actives as $active)
                <tr>
                    <td scope="row"> {{ $active->name }} </td>
                    <td> {{ $active->email }} </td>
                    <td> {{ $active->boon_number }} </td>
                    <td> {{ $active->room_number }} </td>
                    <td>
                        <a href="{{ route('admin.edit', $active->id) }}" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </ul>
</div>
<br>
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Inactive Students</h4>
    </div>
    <ul class="list-group">
        {{ $inactives->links() }}
        <br>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Boon Number</th>
                    <th>Room Number</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inactives as $inactive)
                <tr>
                    <td scope="row"> {{ $inactive->name }} </td>
                    <td> {{ $inactive->email }} </td>
                    <td> {{ $inactive->boon_number }} </td>
                    <td> {{ $inactive->room_number }} </td>
                    <td>
                        <form action=" {{ route('admin.activate', $inactive->id) }} " method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger">Activate</button>
                        </form>
                    </td>
                    <td>
                        <a href=" {{ route('admin.edit', $inactive->id) }} " class="btn btn-primary">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </ul>
</div>
@endsection
