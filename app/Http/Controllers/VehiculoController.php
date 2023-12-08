<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class VehiculoController extends Controller
{

    public function index()
    {
        $vehiculos = Vehiculo::select('vehiculos.placa','vehiculos.marca',
        'color','kilometraje','cliente_dniruc','clientes.nombre as cliente')
        ->join('clientes','clientes.dniruc','=','vehiculos.cliente_dniruc')
        ->paginate(10);

        $clientes = Cliente::all();
        return Inertia::render('Vehiculos/Index',['vehiculos'=> $vehiculos,
        'clientes' => $clientes]);
    }

    public function create()
    {

    }


    public function store(Request $request)
    {
        $request->validate([
            'placa' => 'required|max:7',
            'marca' => 'required|max:100',
            'color' => 'required|max:50',
            'kilometraje' => 'required|max:10, 10',
            'cliente_dniruc' => 'required|numeric'
        ]);

        $vehiculo = new Vehiculo($request->input());
        $vehiculo->save();
        return redirect('vehiculos');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehiculo $vehiculo)
    {
        //
    }


    public function edit(Vehiculo $vehiculo)
    {
        //
    }


    public function update(Request $request, Vehiculo $vehiculo)
    {
        $request->validate([
            'placa' => 'required|max:7',
            'marca' => 'required|max:100',
            'color' => 'required|max:50',
            'kilometraje' => 'required|max:10, 2',
            'cliente_dniruc' => 'required|numeric'
        ]);
        $vehiculo->update($request->input());
        return redirect('vehiculos');
    }

    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();
        return redirect('vehiculos');
    }
    public function VehiculoByCliente(){
        $data = Vehiculo::select(DB::raw('count(vehiculos.placa) as count, clientes.nombre'))
        ->join('clientes','clientes.dniruc','=','vehiculos.cliente_dniruc')
        ->groupBy('clientes.name')->get();
        return Inertia::render('Vehiculos/Graphic',['data' => $data]);
    }
    public function reports(){
        $vehiculos = Vehiculo::select('vehiculos.placa','vehiculos.marca',
        'color','kilometraje','cliente_dniruc','clientes.nombre as cliente')
        ->join('clientes','clientes.dniruc','=','vehiculos.cliente_dniruc')
        ->get();

        $clientes = Cliente::all();
        return Inertia::render('Vehiculos/Index',['vehiculos'=> $vehiculos,
        'clientes' => $clientes]);
    }
}
