<?php

namespace App\Http\Controllers;

use App\Models\Emargement;

class EmargementController extends Controller
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
        return Emargement::all();
    }
}
