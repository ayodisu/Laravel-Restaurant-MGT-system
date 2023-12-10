<?php

namespace App\Http\Controllers\Food;

use App\Http\Controllers\Controller;
use App\Models\Food\Cart;
use Illuminate\Http\Request;
use App\models\Food\Food;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    public function foodDetails($id) 
    {
        $foodItem = Food::find($id);

        //verifying if user added item to cart

        $cartVerifying = Cart::where('food_id', $id)->where('user_id', Auth::user()->id)->count();


        
        return view('food.food-details', compact('foodItem', 'cartVerifying'));
    }
    
    public function cart(Request $request, $id) 
    {
        $cart = Cart::create([
            "user_id" => $request->user_id,
            "food_id" => $request->food_id,
            "name" => $request->name,
            "image" => $request->image,
            "price" => $request->price,
        ]);

        if($cart) {
            return redirect()->route('food.details', $id)->with(['success' => 'Items added to cart successfully']);
        }

        // return view('food.food-details', compact('foodItem'));
    }
}
