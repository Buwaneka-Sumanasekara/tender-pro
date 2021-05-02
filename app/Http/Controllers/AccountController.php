<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    /*
     * Tender create function
     */

    public function account_show_dashboard(Request $request){
       
        return view('account.dashboard.index');
    }
}
