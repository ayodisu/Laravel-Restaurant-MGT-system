<?php

namespace App\Http\Controllers;
use App\models\Food\Food;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $breakfastFoods = Food::select()->take(4)->where('category', 'Breakfast')->orderby('id', 'desc')->get();

        $lunchFoods = Food::select()->take(4)->where('category', 'Lunch')->orderby('id', 'desc')->get();

        $dinnerFoods = Food::select()->take(4)->where('category', 'Dinner')->orderby('id', 'desc')->get();
        return view('home', compact('breakfastFoods', 'lunchFoods', 'dinnerFoods'));
    }
}
