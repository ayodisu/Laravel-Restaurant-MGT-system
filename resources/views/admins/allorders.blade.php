@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="container">
                        @if(Session::has('success'))
                        <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('success') }}</p>
                        @endif
                    </div>
                    <div class="container">
                        @if(Session::has('deleted'))
                        <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('deleted') }}</p>
                        @endif
                    </div>
                    <h5 class="card-title mb-4 d-inline">Orders</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" style="width: 100%; overflow-x: auto;">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Town</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Change Status</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <th scope="row">{{ $order->id }}</th>
                                        <td>{{ $order->name }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->town }}</td>
                                        <td>{{ $order->country }}</td>
                                        <td>{{ $order->phone_number }}</td>
                                        <td>{{ $order->address }}</td>
                                        <td>${{ $order->price }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td><a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning text-white btn-sm text-center">Change
                                                Status</a></td>
                                        <td><a href="{{ route('orders.delete', $order->id) }}" class="btn btn-danger btn-sm text-center">Delete</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
