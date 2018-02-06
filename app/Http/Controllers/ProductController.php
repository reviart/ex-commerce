<?php
namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use App\Product;
use Auth;
use Session;
use App\Http\Requests;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getIndex()
    {
        $products = Product::paginate(6);
        return view('shop.index', compact('products'));
    }

    public function getSuccess(){
      return view('shop.printSuccess');
    }

    public function getAddToCart(Request $request, $id) {
        $product = Product::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id);
        $request->session()->put('cart', $cart);
        return redirect()->route('product.dashboard');
    }

    public function getCart() {
      if (!Session::has('cart')) {
          return view('shop.shopping-cart');
      }
      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);
      return view('shop.shopping-cart', ['products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function getCheckout(){
      if (!Session::has('cart')) {
          return view('shop.shopping-cart');
      }
      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);
      $total = $cart->totalPrice;
      return view('shop.checkout', compact('total'));
    }

    public function postCheckout(Request $request){
      if (!Session::has('cart')) {
          return view('shop.shopping-cart');
      }
      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);

      try {
        $order = new Order();
        //$order->cupay_id = $request->input('cupay_id');
        $order->cart = serialize($cart);
        $order->address = $request->input('address');
        /*
        $order->pembeli
        $order->membayar tampung x
        $order->banyak disc
        proses disc x - $total = $cart->totalPrice;
        $order->totalafterdisc
        */
        Auth::user()->orders()->save($order);
      }
      catch (Exception $e) {
        return redirect()->route('get.checkout')->with('error', $e->getMessage());
      }
      Session::forget('cart');
      return redirect()->route('get.finishOrder')->with('success', 'Success purchased product!');
    }

    public function getReduceByOne($id)
    {
      $oldCart = Session::has('cart') ? Session::get('cart') : NULL;
      $cart = new Cart($oldCart);
      $cart->reduceByOne($id);
      if (count($cart->items) > 0) {
        Session::put('cart',$cart);
      }else {
        Session::forget('cart');
      }
      return redirect()->route('get.shopping.cart');
    }

    public function getRemove($id)
    {
      $oldCart = Session::has('cart') ? Session::get('cart') : NULL;
      $cart = new Cart($oldCart);
      $cart->removeItem($id);
      if (count($cart->items) > 0) {
        Session::put('cart',$cart);
      }
      else {
        Session::forget('cart');
      }
      return redirect()->route('get.shopping.cart');
    }

    public function getPrint(){
      if (!Session::has('cart')) {
          return view('shop.shopping-cart');
      }
      $oldCart = Session::get('cart');
      $cart = new Cart($oldCart);
      $total = $cart->totalPrice;
      return view('shop.printTF', compact('total'));
    }
}
