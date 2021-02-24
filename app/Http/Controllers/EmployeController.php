<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use Illuminate\Http\Request;

class EmployeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(){
        return response()->json(Employe::all());
    }

    public function show($id){
        return response()->json(Employe::find($id));
    }

    public function save(Request $req){
        $this->validate($req,[
            'Matricule' => 'required',
            'Prenom' => 'required',
            'Nom' => 'required',
            'email' => 'required|email|unique:employes',
            'PhoneNumber' => 'required',
        ]);
        $newEmp = Employe::create($req->all());
        return response()->json($newEmp,201);

    }

    public function update($id, Request $req){
        $this->validate($req,[
            //'Matricule' => 'required',
            'Prenom' => 'required',
            'Nom' => 'required',
            'email' => 'required|email|unique:employes',
            'PhoneNumber' => 'required',
        ]);
        $empUpdated = Employe::findOrFail($id);
        $empUpdated->update($req->all());
        return response()->json($empUpdated,200);
        
    }

    public function delete($id){
        $empDeleted = Employe::findOrFail($id)->delete();
        return response("Suppression effectué avec success !!!",200);
    }
}
