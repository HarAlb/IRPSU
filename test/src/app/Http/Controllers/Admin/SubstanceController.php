<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Base\Controller;

use App\Models\Substance;

use App\Http\Requests\SubstanceCreateRequest;
use App\Http\Requests\SubstanceEditRequest;

class SubstanceController extends Controller
{

    public function __construct(){
        $this->model = Substance::query();
        $this->view_path = 'admin.substances';
        $this->route_name = 'substances.';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $substances = $this->model->paginate();
        return $this->getView(__FUNCTION__ , compact('substances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->getView(__FUNCTION__ );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubstanceCreateRequest $req)
    {
        $this->model->create([
            'name' => $req->substance_name,
            'visible' => isset($req->visible)
        ]);
        return redirect(route($this->route_name . 'index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->model->findOrFail($id);
        return $this->getView(__FUNCTION__ , compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubstanceEditRequest $req, $id)
    {
        $item = $this->model->findOrFail($id);

        $has_in_table = Substance::where([
            ['name' , '=',$req->substance_name],
            ['id' , '<>' , $item->id]
        ])->select('id')->first();
        if($has_in_table) return redirect()->back()->withErrors(['error' => 'Name already exists']);
        $item->name = $req->substance_name;
        $item->visible = isset($req->visible);
        $item->save();
        return redirect(route($this->route_name . 'index'));
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
}
