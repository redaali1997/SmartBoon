@extends('layouts.app')
@section('title', 'Orders')
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Reserving Time</h4>
                @if ($time)
                <h5>From {{ (int)$time->start > 12 ? (int)$time->start -12 . ' PM' : (int)$time->start . ' AM' }} To
                    {{ (int)$time->end > 12 ? (int)$time->end -12 . ' PM' : (int)$time->end . ' AM' }}
                </h5>
                @endif
            </div>
            <ul class="list-group">
                <li class="list-group-item">
                    @if ($time)
                    <form action=" {{ route('orders.updateTime', $time->id) }} " method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="start">Start Time</label>
                            <input type="time" class="form-control time_reserving" name="start"
                                value="{{ $time->start }}">
                        </div>
                        <div class="form-group">
                            <label for="">End Time</label>
                            <input type="time" class="form-control time_reserving" name="end" value="{{ $time->end }}">
                        </div>
                        <button class="btn btn-primary" type="submit">Update Time</button>
                    </form>
                    @else
                    <form action=" {{ route('orders.createTime') }} " method="post">
                        @csrf
                        <div class="form-group">
                            <label for="start">Start Time</label>
                            <input type="time" class="form-control time_reserving" name="start" value="">
                        </div>
                        <div class="form-group">
                            <label for="">End Time</label>
                            <input type="time" class="form-control time_reserving" name="end" value="">
                        </div>
                        <button class="btn btn-primary" type="submit">Create Time</button>
                    </form>
                    @endif
                </li>
                <li class="list-group-item">
                    <form action=" {{ route('orders.show') }} " method="get">
                        <div class="form-group">
                            <label for="search">Search by boon number</label>
                            <input type="text" class="form-control" name="search" placeholder="Boon Number"
                                value="{{ request()->query('search') }}">
                        </div>
                        <div class="form-group">
                            <label for="date">Search by date</label>
                            <input type="date" class="form-control" name="date" value="{{request()->query('date')}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Go</button>
                    </form>
                    {{-- <form action=" {{ route('orders.show') }} " method="get">
                    <div class="form-group">
                        <label for="orders_day">Orders Day</label>
                        <select class="form-control" name="orders_day">
                            <option value="today" {{ request()->query('orders_day') === 'today' ? 'selected' : ''}}>
                                Today</option>
                            <option value="yesterday"
                                {{ request()->query('orders_day') === 'yesterday' ? 'selected' : ''}}>Yesterday
                            </option>
                            <option value="older" {{ request()->query('orders_day') === 'older' ? 'selected' : ''}}>
                                Older</option>
                        </select>
                    </div>
                    <button class="btn btn-primary">Go</button>
                    </form> --}}
                </li>
            </ul>
        </div>
    </div>
    <div class="col-md-8">
        {{-- <form action="{{ route('orders.show') }}" method="GET">
        <div class="form-group">
            <input type="text" class="form-control" name="search" id="" aria-describedby="helpId"
                placeholder="Search for a student by boon number" value="{{ request()->query('search') }}">
        </div>
        </form> --}}
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    @if(request()->query('date'))
                    {{ request()->query('date') }}
                    @else
                    Today
                    @endif
                    @if ($orders)
                        Orders
                        <span class="badge badge-pill badge-primary">{{ $orders->count() }} Orders</span></h4>
                    @endif

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
                        @if ($orders)
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
                                        @if ($order->open)
                                        <form action="{{ route('orders.closeOrder', $order->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-secondary" type="submit">Close order</button>
                                        </form>
                                        @endif
                                        {{-- <form action="{{ route('orders.deleteOrder', $order->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                                <tr>
                                    <p class="alert alert-danger">There is no data</p>
                                </tr>
                        @endif
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
    flatpickr(".orders_date");
</script>
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
