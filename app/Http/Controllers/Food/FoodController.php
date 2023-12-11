<?php

namespace App\Http\Controllers\Food;

use App\Http\Controllers\Controller;
use App\Models\Food\Cart;
use App\Models\Food\Checkout;
use Illuminate\Http\Request;
use App\models\Food\Food;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Session as FacadesSession;

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

        if ($cart) {
            return redirect()->route('food.details', $id)->with(['success' => 'Items added to cart successfully']);
        }

        // return view('food.food-details', compact('foodItem'));
    }


    public function displayCartItems()
    {

        if (auth()->user()) {
            //display cart items
            $cartItems = Cart::where('user_id', Auth::user()->id)->get();

            //display price
            $price = Cart::where('user_id', Auth::user()->id)->sum('price');



            return view('food.cart', compact('cartItems', 'price'));
        } else {
            abort('404');
        }
    }


    public function deleteCartItems($id)
    {

        //delete cart items
        $deleteItem = Cart::where('user_id', Auth::user()->id)->where('food_id', $id);

        $deleteItem->delete();

        if ($deleteItem) {
            return redirect()->route('food.display.cart')->with(['delete' => 'Items deleted successfully']);
        }
    }

    public function prepareCheckout(Request $request, $id)
    {
        $value = $request->price;
        $price = session(['price' => $value]);
        $newPrice = FacadesSession::get('price');

        if ($newPrice > 0) {
            if (FacadesSession::get('price') == 0) {

                abort('403');
            } else {

                return redirect()->route('food.checkout');
            }
        }
    }

    public function checkout()
    {
        if (FacadesSession::get('price') == 0) {

            abort('403');
        } else {

            return view('food.checkout');
        }
    }


    public function storeCheckout(Request $request)
    {
        $checkout = Checkout::create([
            "name" => $request->name,
            "email" => $request->email,
            "town" => $request->town,
            "country" => $request->country,
            "phone_number" => $request->phone_number,
            "address" => $request->address,
            "user_id" => Auth::user()->id,
            "price" => $request->price,

        ]);

        // echo "paypal";

        if ($checkout) {

            if (FacadesSession::get('price') == 0) {

                abort('403');
            } else {

                return redirect()->route('food.pay');
            }
        }

        // return view('food.food-details', compact('foodItem'));
    }


    public function pay()
    {
        if (FacadesSession::get('price') == 0) {

            abort('403');
        } else {

            return view('food.pay');
        }
    }


    public function success()
    {
        //delete cart items
        $deleteItem = Cart::where('user_id', Auth::user()->id);

        $deleteItem->delete();

        if ($deleteItem) {

            if (FacadesSession::get('price') == 0) {

                abort('403');
            } else {

                FacadesSession::forget('price');
                
                return view('food.success')->with(['success' => 'Payment Successful']);
            }
        }

        

        return view('food.pay');
    }
}
