<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\Food\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class usersController extends Controller
{
    public function getBookings()
    {
        $allBookings = Booking::where('user_id', Auth::user()->id)->get();

        return view('users.bookings', compact('allBookings'));
    }
}
