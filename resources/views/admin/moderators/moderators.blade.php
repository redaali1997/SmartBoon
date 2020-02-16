@extends('layouts.app')
@section('title', 'Moderators')
@section('content')
<div class="card">
    <div class="card-body">
        <h4 class="card-title">Moderators</h4>
    </div>
    <ul class="list-group">
        <table class="table">
            <thead>
                <tr>
                    <td>Name</td>
                    <td>Email</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($moderators as $moderator)
                <tr>
                    <td>{{$moderator->name}}</td>
                    <td>{{$moderator->email}}</td>
                    <td><a href=" {{ route('admin.edit', $moderator->id) }} " class="btn btn-primary">Edit</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @foreach ($moderators as $moderator)
        @endforeach
    </ul>
</div>
@endsection
