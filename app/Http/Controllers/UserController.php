<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Session;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getSignup(){
      return view('user.signup');
    }

    public function postSignup(Request $request){
      $this->validate($request, [
        'name' => 'required|string|max:100',
        'email' => 'required|string|email|max:100|unique:users',
        'password' => 'required|string|min:4',
      ]);

      $user = new User([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => bcrypt($request->input('password'))
      ]);
      $user->save();
      Auth::login($user);

      if (Session::has('oldUrl')) {
        $oldUrl = Session::get('oldUrl');
        Session::forget('oldUrl');
        return redirect()->to($oldUrl);
      }
      return redirect()->intended(route('get.user.profile'));
    }

    public function getSignin(){
      return view('user.signin');
    }

    public function postSignin(Request $request){
      $this->validate($request, [
        'email' => 'required',
        'password' => 'required|string|min:4',
      ]);

      if (Auth::attempt([
          'email' => $request->input('email'),
          'password' => $request->input('password')
        ])) {
          if (Session::has('oldUrl')) {
            $oldUrl = Session::get('oldUrl');
            Session::forget('oldUrl');
            return redirect()->to($oldUrl);
          }
        return redirect()->intended(route('get.user.profile'));
      }
      return redirect()->back();
    }

    public function getProfile(){
      $orders = Auth::user()->orders;
      $orders->transform(function($order, $key){
        $order->cart = unserialize($order->cart);
        return $order;
      });
      return view('user.profile', compact('orders'));
    }
    public function getLogout(){
      Auth::logout();
      return redirect('home');
    }
}
