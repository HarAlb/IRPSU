<?php

namespace App\Http\Controllers\Admin\Base;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller as BaseController;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $model;
    protected $view_path;
    protected $route_name;
    protected $allowViews = [
        'index'  =>  '/list',
        'create' => '/create',
        'show'   => '/index',
        'edit'   => '/edit',
        
    ];


    public function getView($function , $array = []){
        if(isset($this->allowViews[$function])) return view($this->view_path . $this->allowViews[$function] , $array);
        dd('Please add index in allowViews array' , __FILE__);
    }
}