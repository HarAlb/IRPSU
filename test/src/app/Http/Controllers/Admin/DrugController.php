<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Base\Controller;

use App\Http\Requests\DrugEditRequest;
use Illuminate\Http\Request;

use App\Models\Drug;
use App\Models\Substance;
use App\Models\DrugSubstance;

class DrugController extends Controller
{
    public function __construct(){
        $this->model = Drug::query();
        $this->view_path = 'admin.drugs';
        $this->route_name = 'drugs.';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drugs = $this->model->with('substances')->paginate();
        return $this->getView(__FUNCTION__ , compact('drugs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  alternative way Route::view , but i use resource i didnt change routes
        return $this->getView(__FUNCTION__ );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DrugEditRequest $req)
    {
        $drug = $this->model->create([
            'name' => $req->drug_name
        ]);
        if($drug){
            $new_substances = $this->getNewSubstance($req->substance);
            if(is_array($new_substances) && $this->insertDrugSubstance($drug->id , $new_substances , $req->primary)) {
                return redirect(route($this->route_name . 'index'));
            }  
        }
        return redirect()->back()->withErrors(['error' => 'Problem with db']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $with_relation = \Auth::user()->is_admin ? 'substances' : 'substancesNotPrimary';
        $item = $this->model->with($with_relation)->findOrFail((int) $id);
        $relations = Drug::with($with_relation)->inRandomOrder()->where('id' , '<>' , $item->id)->limit(5)->get();
        return $this->getView(__FUNCTION__ , compact('item' , 'relations' , 'with_relation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->model->with('substances')->findOrFail($id);
        return $this->getView(__FUNCTION__ , compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DrugEditRequest $req, $id)
    {   
        $drug = $this->model->findOrFail($id);
        $new_substances = $this->getNewSubstance($req->substance);
        if(is_array($new_substances)){
            $drug->relations()->delete();
            if($this->insertDrugSubstance($drug->id , $new_substances , $req->primary)){
                $drug->name = $req->drug_name;
                $drug->save();
                return redirect(route($this->route_name . 'index'));
            }
            
        }
        return redirect()->back()->withErrors(['substanceError', 'Substances Doesnt exist']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->model->find($id)->delete();
        return redirect(route($this->route_name . 'index')); 
    }

    public function getNewSubstance($array){
        $substances = Substance::select('id')->pluck('id')->toArray();
        $new_substances = array_intersect($array , $substances );
        if(empty($new_substances)) return 'Please create substances';
        return $new_substances;
    }

    public function insertDrugSubstance($drug_id , $new_substances , $primary){
        $insert = [];
            foreach($new_substances as $key){
                $insert[] = [
                    'drug_id' => $drug_id,
                    'substance_id' => (int) $key,
                    'visible' => $primary === $key ? 0: 1 
                ];
            }
        return DrugSubstance::insert($insert);
    }
}
