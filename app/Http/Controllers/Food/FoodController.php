<?php

namespace App\Http\Controllers\Food;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Food\Food;

class FoodController extends Controller
{
    public function foodDetails($id) 
    {
        $foodItem = Food::find($id);
        return view('food.food-details', compact('foodItem'));
    }
}
