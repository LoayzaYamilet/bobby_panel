<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClienteController extends Controller
{

    public function index()
    {
        $cliente = Cliente::all();
        return Inertia::render('Cliente/Index',['cliente' => $cliente]);
    }


    public function create()
    {
        return Inertia::render('Cliente/Create');
    }


    public function store(Request $request)
    {
        $request->validate(['dni_ruc'=>'required|max:11']);
        $request->validate(['nombre'=>'required|max:100']);
        $request->validate(['telefono'=>'required|max:100']);
        $cliente = new Cliente($request->input());
        $cliente->save();
        return redirect('cliente');

    }


    public function show(Cliente $cliente)
    {
        //
    }

    public function edit(Cliente $cliente)
    {
        return Inertia::render('Cliente/Edit',['cliente' => $cliente]);
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate(['dni_ruc'=>'required|max:11']);
        $request->validate(['nombre'=>'required|max:100']);
        $request->validate(['telefono'=>'required|max:100']);
        $cliente->update($request->all());
        return redirect('cliente');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect('cliente');
    }
}
