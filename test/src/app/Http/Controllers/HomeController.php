<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Drug;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $req)
    { 
        $drugs = [];
        $message = '';
        $count_substance = $req->substance ? count($req->substance) : 0;
        if($count_substance > 1){
            $drugs = Drug::join('drug_substance' , 'drug_substance.drug_id' , 'drugs.id')
                    ->leftJoin('substances' , 'substances.id' , 'drug_substance.substance_id')
                    ->whereIn('substances.id' , $req->substance)
                    ->select('drugs.name' , 'drugs.id' , \DB::raw('LENGTH(REGEXP_REPLACE(GROUP_CONCAT(substances.id)  , "[0-9]*" , "") ) + 1 as count_intersect'))
                    ->groupBy('drug_substance.drug_id')
                    ->with('substancesNotPrimary')
                    ->get();
            if($drugs->where('count_intersect' , $count_substance)->count()){
                $drugs = $drugs->where('count_intersect' , $count_substance);
            }
            
            $drugs =  \App\Helper\PaginateHelper::paginate($drugs->sortByDesc('count_intersect') , 5)->appends(['substance' => $req->substance]);
            if($drugs->count() <= 1){
                $drugs = [];
                $message = 'не найдено лекарств';
            }
        }else{
            $message = $req->substance ? 'не ленись, добавь веществ' : '';
        }
        return view('home' , compact('drugs' , 'message') );
    }
}
