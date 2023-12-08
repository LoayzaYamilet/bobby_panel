<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClienteController extends Controller
{

    public function index()
    {
        $clientes = Cliente::all();
        return Inertia::render('Clientes/Index',['clientes' => $clientes]);
    }


    public function create()
    {
        return Inertia::render('Clientes/Create');
    }


    public function store(Request $request)
    {
        $request->validate(['dniruc'=>'required|max:11']);
        $request->validate(['nombre'=>'required|max:100']);
        $request->validate(['telefono'=>'required|max:100']);
        $cliente = new Cliente($request->input());
        $cliente->save();
        return redirect('clientes');

    }


    public function show(Cliente $cliente)
    {
        //
    }

    public function edit(Cliente $cliente)
    {
        return Inertia::render('Clientes/Edit',['cliente' => $cliente]);
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate(['dniruc'=>'required|max:11']);
        $request->validate(['nombre'=>'required|max:100']);
        $request->validate(['telefono'=>'required|max:100']);
        $cliente->update($request->all());
        return redirect('clientes');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect('clientes');
    }
}
