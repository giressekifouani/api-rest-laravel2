<?php

namespace App\Http\Controllers;
//use App\Http\Controllers\ServicesController;
use App\Models\services;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        return response()->json(Services::all());
    }

    public function store(Request $request){
        $validated = $request->validate([
            'nom'=> 'required | string | max:200',
            'description'=> 'required | string | max:255',
            'categorie'=> 'required |string | max:100',
            'prix'=> 'required |string |max:20',
            'durer'=> 'required |string|max:100',
        ]);
        $services = Services::create($validated);
        return response()->json($services, 201);
    }

    public function create(Request $request){
        $validated = $request->validate([
            'nom'=> 'required | string | max:200',
            'description'=> 'required | string | max:255',
            'categorie'=> 'required |string | max:100',
            'prix'=> 'required |string |max:20',
            'durer'=> 'required |string|max:100',
        ]);
        $services = Services::create($validated);
        return response()->json($services, 201);
    }

    public function update(Request $request, $id){

    }

    public function show($id){
        $services = Services::findOrFail($id);
        return response()->json($services);
    }
}
