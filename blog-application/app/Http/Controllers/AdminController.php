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

        return view('pages.dashboard');
    }

}  
  
   


   

