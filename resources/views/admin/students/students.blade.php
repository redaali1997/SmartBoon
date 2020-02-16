@extends('layouts.app')
@section('title', 'Students')
@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Active Students</h4>
    </div>
    <ul class="list-group">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Boon Number</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($actives as $active)
                <tr>
                    <td scope="row"> {{ $active->name }} </td>
                    <td> {{ $active->email }} </td>
                    <td> {{ $active->boon_number }} </td>
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
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Boon Number</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($inactives as $inactive)
                <tr>
                    <td scope="row"> {{ $inactive->name }} </td>
                    <td> {{ $inactive->email }} </td>
                    <td> {{ $inactive->boon_number }} </td>
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
