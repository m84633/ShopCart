<?php

namespace App\Http\Controllers;

use App\Book;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        // $book = Book::where('id',1)->get();
        // dd($book);

        // $a = session('cart');
        // dd(serialize($a));

        // return (string) Str::orderedUuid();
        // dd(json_encode(session('cart')));
        return view('shop.shop',compact('books'));
    }

    public function checkout(){
        if(session('cart')){
            $cart = session('cart');
            // dd($cart);
            return view('shop.checkout',compact('cart'));
        }else{
            return redirect('/');
        }
    }

    public function addToCart(Request $request){
        $book = Book::find($request->id);
        $lastcart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($lastcart);
        $cart->add($book,$book->id);
        $request->session()->put('cart',$cart);
        return Session::get('cart')->totalQty;
    }

    public function removeItem(Request $request){
        $lastcart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($lastcart);
        $cart->removeItem($request->id);
        if(count($cart->items) > 0){
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }       
    }

    public function minus_one(Request $request){
        $lastcart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($lastcart);
        $cart->reduceByOne($request->id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }else{
            Session::forget('cart');
        }
    }

    public function shopCart(){
        $cart = Session::get('cart');
        return view('shop.shopcart',compact('cart'));
    }
    
    public function getCar(){
        if(session('cart')){
            return json_encode(session('cart'));
        }
    }

    public function bought(){
        if (session('status')){
            session()->forget('status');
            session()->save();
            return 1;
        }
    }

}
