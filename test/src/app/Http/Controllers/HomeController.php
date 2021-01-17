<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            $drug_substances = \App\Models\DrugSubstance::whereIn('substance_id' , $req->substance)
            ->where('visible' , 1)
            ->select('drug_id' , \DB::raw('group_concat(substance_id) as substances'))
            ->groupBy('drug_id')
            ->orderBy(\DB::raw('LENGTH(substances)') , 'DESC')
            ->get();
            $res = [];
            
            // Dont need $i but performace is more better then without index
            foreach($drug_substances as $i => $drug_substance){
                $count_intersect = count(array_intersect($req->substance , explode(',' , $drug_substance->substances)));
                if($count_substance === $count_intersect){
                    $res['target'][] = $drug_substance->drug_id;
                };
                if(!isset($res['target'])){
                    if($count_intersect <= 2) continue;
                    $res['have_pice'][] = ['drug' => $drug_substance->drug_id , 'count_intersect' => $count_intersect];
                }
            }
            $res_ids = [];
            if(isset($res['target'])){
                $res_ids = $res['target'];
            }elseif(isset($res['have_pice'])){
                $res_ids = collect($res['have_pice'])->pluck('drug')->toArray();
            }
            
            $drugs = \App\Models\Drug::whereIn('id' , $res_ids)->orderBy(\DB::raw('FIELD(`id` , ' . implode(',' , $res_ids) . ')'))->with('substancesNotPrimary')->paginate()->appends(['substance' => $req->substance]);
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
