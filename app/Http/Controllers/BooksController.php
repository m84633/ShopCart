<?php

namespace App\Http\Controllers;

use App\Book;
use App\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        return view('shop.shop',compact('books'));
    }

    public function checkout(){
        return view('shop.checkout');
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

    public function getQty(){
        if(session('cart')){
            return session('cart')->totalQty;
        }
    }

    public function get_items(){
        if(session('cart')){
            return session('cart')->items;
        }
    }

    public function get_sum(){
        if(session('cart')){
            return session('cart')->totalPrice;
        }
    }

    public function get_itemQty(){
        if(session('cart')){
            return count(session('cart')->items);
        }
    }

}
