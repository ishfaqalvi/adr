<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User,Chemical,Subscription,Invoice};

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $data = [
            'chemicals'   => Chemical::count(),
            'users'       => User::count(),
            'invoices'    => Invoice::count(),
            'subscription'=> Subscription::count(),
        ];
        return view('admin.dashboard', compact('data'));
    }
}
