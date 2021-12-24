<?php

namespace App\Http\Controllers;

use App\Models\Reservas;
use App\Models\Butacas;
use App\Models\User;
use Illuminate\Http\Request;

class ReservasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reservas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users['users'] = User::all();
        $datos = request()->all();
        $users['fecha'] = date('d-m-Y', strtotime($datos['fecha']));
        $users['fechaformat'] = date('Y-m-d', strtotime($datos['fecha']));
        $fecha = date('Y-m-d', strtotime($datos['fecha']));

        $reservas = Reservas::select(['id'])->where('fecha', '=', $fecha)->get();
        $butacas = array();
        foreach ($reservas as $reserva){
            $butacasreserva = Butacas::where('reserva_id', '=', $reserva['id'])->get();
            foreach ($butacasreserva as $butacareserva){
                array_push($butacas, 'F' . $butacareserva['fila'] . 'C' . $butacareserva['columna']);
            }
            
        }
        $users['butacas'] = $butacas;

        return view('reservas.create', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosReserva = request()->except("_token");

        $Reserva['usuario_id'] = $datosReserva['usuario'];
        $Reserva['fecha'] = $datosReserva['fecha'];
        unset($datosReserva['usuario']);
        unset($datosReserva['fecha']);
        $id = Reservas::insertGetId($Reserva);
        foreach($datosReserva as $butaca){
            $but['reserva_id'] = $id;
            $but['fila'] = substr($butaca, 1, 1);
            $but['columna'] = explode('C', $butaca)[1];
            Butacas::insert($but);
        }
        //return response()->json($but);
        return redirect('reservas')->with('mensaje', 'Reserva registrada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservas  $reservas
     * @return \Illuminate\Http\Response
     */
    public function show(Reservas $reservas)
    {
        $peticion = request()->all();
        $reservas['reservas'] =Reservas::where('fecha', '=', $peticion['fecha'])->get();
        foreach($reservas['reservas'] as $reserva){
            $cantbutacas = 0;
            $butacas = Butacas::where('reserva_id', '=', $reserva->id)->get();
            foreach($butacas as $butaca){
                $cantbutacas++;
                if ($cantbutacas>1) $reserva['butacas'] .= '-';
                $reserva['butacas'] .= 'F' . $butaca->fila . 'C' . $butaca->columna;
            }
            $reserva['cantidad'] = $cantbutacas;
        }
        return view('reservas.show', $reservas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reservas  $reservas
     * @return \Illuminate\Http\Response
     */
    public function edit(Reservas $reservas)
    {
        return view('reservas.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservas  $reservas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservas $reservas)
    {
        return view('reservas.update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservas  $reservas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reservas $reservas)
    {
        return view('reservas.destroy');
    }
}
