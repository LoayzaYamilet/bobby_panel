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
        $vehiculo = Vehiculo::select('vehiculo.placa','vehiculo.marca',
        'color','kilometraje','cliente_dni_ruc','cliente.nombre as cliente')
        ->join('cliente','cliente_dni_ruc','=','vehiculo.cliente_dni_ruc')
        ->paginate(10);

        $cliente = Cliente::all();
        return Inertia::render('Vehiculo/Index',['vehiculo'=> $vehiculo,
        'cliente' => $cliente]);
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
            'cliente_dni_ruc' => 'required|numeric'
        ]);

        $vehiculo = new Vehiculo($request->input());
        $vehiculo->save();
        return redirect('vehiculo');
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
            'cliente_dni_ruc' => 'required|numeric'
        ]);
        $vehiculo->update($request->input());
        return redirect('vehiculo');
    }

    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();
        return redirect('vehiculo');
    }
    public function VehiculoByCliente(){
        $data = Vehiculo::select(DB::raw('count(vehiculo.placa) as count, cliente.nombre'))
        ->join('cliente','cliente.dni_ruc','=','vehiculo.cliente_dni_ruc')
        ->groupBy('cliente.name')->get();
        return Inertia::render('Vehiculo/Graphic',['data' => $data]);
    }
    public function reports(){
        $vehiculo = Vehiculo::select('vehiculo.placa','vehiculo.marca',
        'color','kilometraje','cliente_dni_ruc','cliente.nombre as cliente')
        ->join('cliente','cliente_dni_ruc','=','vehiculo.cliente_dni_ruc')
        ->get();

        $cliente = Cliente::all();
        return Inertia::render('Vehiculo/Index',['vehiculo'=> $vehiculo,
        'cliente' => $cliente]);
    }
}
