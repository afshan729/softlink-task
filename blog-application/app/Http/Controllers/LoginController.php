<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(){

        return view('pages.login');
    }
    public function login(Request $request)
    {

        if ($request->isMethod('POST')) {
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);
            $admin = User::where('email', $request->email)->first();
            if (!$admin || !Hash::check($request->password, $admin->password)) {
                // dd($admin->password); 
                return response()->json([
                    'error' => 'Login Failure: Email or Password is incorrect.'
                ],403);
            }else{
                if ($admin->active == 0) {
                    return response()->json([
                        'error' => 'Account Inactive.'
                    ],403);
                }
                if($admin->role_id == 1){
                    session()->put('admin', $admin);
                    return response()->json([
                        'message' => 'Admin'
                    ],200);
                }
                if($admin->role_id == 2){
                    return response()->json([
                        'message' => 'subadmin'
                    ],200);
                }
                return response()->json([
                    'message' => 'Login Success!'
                ],200);
            }
        } else {
            if (session()->has('admin')) {
                return redirect()->route('admin.dashboard');
            }
            return view('pages.login');
        }
        
    }



    public function logout()
    {
        session()->remove('admin');
        return redirect()->route('admin.login');

    }

}
