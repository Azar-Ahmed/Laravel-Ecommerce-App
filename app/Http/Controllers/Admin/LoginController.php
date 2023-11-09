<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index() {
        return view('admin.login');
    }

    public function authenticate(Request $request) {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if($validate->passes()){
            if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))){
                $admin = Auth::guard('admin')->user();
                if($admin->role === 0){
                    return redirect()->route('admin.dashboard');
                }else{
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin.login')->with('error', 'Access Denied!');
                }
            }else{
                return redirect()->route('admin.login')->with('error', 'Invalid Email/Password!');
            }
        }else{
            return redirect()->route('admin.login')->withErrors($validate)->withInput($request->only('email'));
        }

    }

}
