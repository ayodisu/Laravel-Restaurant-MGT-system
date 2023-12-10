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


    public function displayCartItems() 
    {

        if(auth()->user()) {
            //display cart items
            $cartItems = Cart::where('user_id', Auth::user()->id)->get();

            //display price
            $price = Cart::where('user_id', Auth::user()->id)->sum('price');


            
            return view('food.cart', compact('cartItems', 'price'));

        }else {
            abort('404');
        }

        
    }


    public function deleteCartItems($id) 
    {

        //delete cart items
        $deleteItem = Cart::where('user_id', Auth::user()->id)->where('food_id', $id);

        $deleteItem->delete();
        
        if($deleteItem) {
            return redirect()->route('food.display.cart')->with(['delete' => 'Items deleted successfully']);
        }
    }
}
