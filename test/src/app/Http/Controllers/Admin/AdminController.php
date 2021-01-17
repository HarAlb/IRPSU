<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Models\Drug;
use App\Models\User;

use App\Helper\Helper;

class AdminController extends Controller
{
    public function index(){
        $user = \Auth::user();
        $drugs  = Helper::getCount('drug');
        $substances = Helper::getCount('substance');
        $users = Helper::getCount('user');
        return view('admin.dashboard' , compact(['user' , 'drugs' , 'users' , 'substances']));
    }
}
