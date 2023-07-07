<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;
use App\Models\Inventory;
use App\Models\OrderDispatched;
use App\Models\Order;

use Illuminate\Http\Request;
use App\Models\UserModel;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function dashboard(){

        if (session()->has('admin')) {

        //Total Cost Of Inventory
        $totalCostInventory=Inventory::select('total_price')->sum('total_price');

        //Total no. of Inventory
        $totalNoInventory=Inventory::select('id')->where('status_id', 1)->count('id');

         //Total Cost Of dispatched orders
         $totalCostDispatchOrders=OrderDispatched::select('total_amount')->sum('total_amount');

         //Total no. of orders
         $totalNoOrders=Order::select('id')->count('id');
 


        return view('pages.dashboard' , 
        compact('totalCostInventory','totalNoInventory','totalCostDispatchOrders', 'totalNoOrders'));
        }else{
            return redirect()->route('admin.login');        }
    }

    public function view(){

        $users=UserModel::get();
        $roles=Roles::get();


        return view('user.user-view', compact('users','roles'));

    }

    public function addUser(Request $request){
        $validator = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required',
            'status' => 'required',
            'password' => 'required',
            'confirm_password' => 'required',

        ]);
        if($validator){
            $user=new UserModel;
            $user->firstname = $request->first_name;
            $user->lastname = $request->last_name;
            $user->email = $request->email;
            $user->role_id = $request->role_id;
            $user->active = $request->status;
            $user->password = Hash::make($request->password);

            $user->save();

            return response()->json(['success' => true]);


        }else{

            return response()->json([
                "message" => "Something went wrong!",
                "status" => "error",
            ], 400);
           
        }

    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('POST')) {
            //dd($id);

        $user=UserModel::where('id', $id)->first();
       
        $user->firstname = $request->first_name;
        $user->lastname = $request->last_name;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->active = $request->status;


        if($user->save()){

            return response()->json(['success' => true]);


        }else{

            return response()->json([
                "message" => "Something went wrong!",
                "status" => "error",
            ], 400);
           
        }
    }else{
        $user=UserModel::where('id', $id)->get();
        //dd($user);
        return view('user.user-edit', compact('user'));

    }

    }

    public function destroy(Request $request){
        $user=UserModel::where('id', $request->id)->first();
        $user->delete();
        return response()->json("Done");

       

    }

    public function changePassword(Request $request, $id)
    {
        if ($request->isMethod('POST')) {

//dd($id);
        $user=UserModel::where('id', $id)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['success' => true]);
        }else{
            $user=UserModel::where('id', $id)->get();
            return view('user.change-password', compact('user'));
        }

       

    }
}
