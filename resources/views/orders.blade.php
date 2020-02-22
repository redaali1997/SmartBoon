@extends('layouts.app')
@section('title', 'Orders')
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Reserving Time</h4>
            </div>
            <ul class="list-group">
                <li class="list-group-item">
                    <form action=" {{ route('orders.timeChanging') }} " method="post">
                        @csrf
                        <div class="form-group">
                            <label for="start">Start Time</label>
                            <input type="text" class="form-control time_reserving" name="start"
                                value="{{ $time->start }}">
                        </div>
                        <div class="form-group">
                            <label for="">End Time</label>
                            <input type="text" class="form-control time_reserving" name="end" value="{{ $time->end }}">
                        </div>
                        <button class="btn btn-primary" type="submit">Update Time</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Today Orders : {{ $orders->count() }} Orders</h4>
            </div>
            <ul class="list-group">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Boon Number</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td scope="row"> {{ $order->user->name }} </td>
                            <td> {{ $order->user->boon_number }} </td>
                            <td>
                                @if ($order->open === 1)
                                Opened
                                @else
                                Closed
                                @endif
                            </td>
                            <td> {{ $order->created_at }} </td>
                            <td>
                                <form action="{{ route('orders.deleteOrder', $order->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </ul>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr(".time_reserving", {
    enableTime: true,
    noCalendar: true,
    dateFormat: "H:i:s",
    });
</script>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
