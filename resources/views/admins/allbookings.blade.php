@extends('layouts.admin')

@section('content')

<div class="row">
	<div class="col">
	  <div class="card">
		<div class="card-body">
		  <h5 class="card-title mb-4 d-inline">Bookings</h5>
		
		  <div class="table-responsive">
			<table class="table table-striped table-bordered" style="width: 100%; overflow-x: auto;">
			<thead>
			  <tr>
				<th scope="col">#</th>
				<th scope="col">name</th>
				<th scope="col">email</th>
				<th scope="col">date_booking</th>
				<th scope="col">num_people</th>
				<th scope="col">special_request</th>
				<th scope="col">status</th>
				<th scope="col">change_status</th>
				<th scope="col">created_at</th>
				<th scope="col">delete</th>
			  </tr>
			</thead>
			<tbody>
				@foreach ($bookings as $booking)
					<tr>
				<th scope="row">{{ $booking->id }}</th>
				<td>{{ $booking->name }}</td>
				<td>{{ $booking->email }}</td>
				<td>{{ $booking->date }}</td>
				<td>{{ $booking->num_people }}</td>
				<td>{{ $booking->spe_request }}</td>
				<td>{{ $booking->status }}</td>
				<td><a href="#" class="btn btn-warning text-white  text-center ">change status</a></td>
				<td>{{ $booking->created_at }}</td>
				 <td><a href="delete-bookings.html" class="btn btn-danger  text-center ">delete</a></td>
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