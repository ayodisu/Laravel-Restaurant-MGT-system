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
                    <h5 class="card-title mb-5 d-inline">Update Booking</h5>
                    <p>Status is <b>{{ $bookings->status }}</b></p>
                    <form method="POST" action="{{ route('bookings.update', $bookings->id) }}" enctype="multipart/form-data">
                        @csrf
                        <select name="status" class="form-select  form-control" aria-label="Default select example">
                            <option selected>Choose Status</option>
                            <option value="Processing">Processing</option>
                            <option value="Booked">Booked</option>
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
