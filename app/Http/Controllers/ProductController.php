<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
//use Cartalyst\Stripe\Laravel\Facades\Stripe;
// use Illuminate\Support\Facades\Facade;
//Cartalyst\Stripe\Stripe
//Illuminate\Support\Facades\Facade

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'Qty' => 'required|numeric|min:1'
        ]);
        $cart = new Cart(session()->get('cart'));
        $cart->updateQty($product->id,$request->Qty);
        session()->put('cart',$cart);
        return redirect()->route('cart.show')->with('sucess','Product updated');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $cart = new Cart(session()->get('cart'));
        $cart->remove($product->id);
        if($cart->totalQty <= 0)
        {
            session()->forget('cart');
        }else{
            session()->put('cart',$cart);
        }
        return redirect()->route('cart.show')->with('sucess','Product was removed');
    }

    public function addToCart(Product $product)
    {
        if(session()->has('cart'))
        {
            $cart = new Cart(session()->get('cart'));
        }else{
            $cart = new Cart();
        }
        $cart->add($product);
        //dd($cart);

        session()->put('cart',$cart);
        return redirect()->route('product.index')->with('sucess','Product was Added');
    }

    public function showCart()
    {
        if(session()->has('cart'))
        {
            $cart = new Cart(session()->get('cart'));
        }else{
            $cart = null;
        }
        return view('cart.show',compact('cart'));
    }

    public function checkout($amount)
    {
        return view('cart.checkout',compact('amount'));
    }

    public function charge(Request $request)
    {
        //dd($request->stripeToken);
        $charge = Stripe::charges()->create([
            'amount' => 100*100,
            'currency' => "USD",
            'source' => $request->stripeToken,
            'amount' => $request->amount,
            'description' => "Test payment from mahmoud"
        ]);
        $chargeId = $charge['id'];

        if($chargeId)
        {
            // save order in orders table
            Order::create([
                'cart' => serialize(session()->get('cart')),
                'user_id' => auth()->user()->id,
            ]);
            //clean cart
            session()->forget('cart');
            return redirect()->route('store')->with('success','payment was done');
        }else{
            return redirect()->back();
        }
    }


    public function addCart(Product $product)
    {
        if(session()->has('cart'))
        {
            //find or fail
            // insert in table cart colunm num = 2
        }else{
            // insert in table cart all column
            // session key cart for easy check
        }

        // in cart icon num and in page cart card of items and in card small div for num of this item

    }
}
