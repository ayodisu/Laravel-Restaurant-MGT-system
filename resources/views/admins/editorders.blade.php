@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-5 d-inline">Update Order</h5>
                    <p>Status is <b>{{ $order->status }}</b></p>
                    <form method="POST" action="{{ route('orders.update', $order->id) }}" enctype="multipart/form-data">
                        @csrf
                        <select name="status" class="form-select  form-control" aria-label="Default select example">
                            <option selected>Choose Status</option>
                            <option value="Processing">Processing</option>
                            <option value="Delivering">Delivering</option>
                            <option value="Delivered">Delivered</option>
                        </select>
                </div>

                <br>



                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>


                </form>

            </div>
        </div>
    </div>
    </div>
@endsection
