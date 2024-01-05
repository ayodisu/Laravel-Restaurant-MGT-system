<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Food\Booking;
use App\Models\Food\Checkout;
use App\Models\Food\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    public function viewLogin()
    {
        return view('admins.login');
    }

    public function checkLogin(Request $request)
    {
        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            
            return redirect() -> route('admins.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }

    public function index()
    {
       
        //Fooods Count
         $foodCount = Food::select()->count();
         $checkoutCount = Checkout::select()->count();
         $bookingsCount = Booking::select()->count();
         $adminCount = Admin::select()->count();
       
        return view('admins.index', compact('foodCount', 'adminCount', 'bookingsCount', 'checkoutCount'));
    }

    //Admins
    public function allAdmins()
    {
        $admins = Admin::select()->orderBy('id', 'desc')->get();

        return view('admins.alladmins', compact('admins'));
    }

    public function createAdmins()
    {

        return view('admins.createadmins');
    }

    public function storeAdmins(Request $request)
    {

        Request()->validate([

            "name" => "required|max:40",
            "email" => "required|max:40",
            "password" => "required"
        ]);

        $admins= Admin::create([

            "name" => $request->name,
            "email" => $request->email,
            "password" => Hash::make($request->password)
        ]);

        if ($admins) {
            return redirect()->route('admins.all')->with(['success' => 'Admin added successfully']);
        }

    }
}