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
        //Conseguimos los usuarios existentes para pasarlo a la vista para listarlo
        $users['users'] = User::all();

        //Recogemos los datos de la petición para saber la fecha para la reserva
        $datos = request()->all();
        
        //Tratamiento de la fecha para mostrar y para pasar a bbdd
        if($datos['fecha']==null) $datos['fecha'] = date('Y-m-d');
        $users['fecha'] = date('d-m-Y', strtotime($datos['fecha']));
        $users['fechaformat'] = date('Y-m-d', strtotime($datos['fecha']));
        $fecha = date('Y-m-d', strtotime($datos['fecha']));

        //Conseguimos las reservas existentes con sus butacas correspondientes
        //para pasarselas a la siguiente vista donde se realiza la seleccion de las butacas
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
        //Recogemos los datos de la peticion que contiene la informacion de la reserva y butacas
        $datosReserva = request()->except("_token");

        //Formamos la reserva que vamos a crear
        $Reserva['usuario_id'] = $datosReserva['usuario'];
        $Reserva['fecha'] = $datosReserva['fecha'];
        $id = Reservas::insertGetId($Reserva);
        
        //Limpiamos los datos de la reserva para quedarnos unicamente con las butacas que tenemos que crear
        unset($datosReserva['usuario']);
        unset($datosReserva['fecha']);
        
        //Bucle para crear las butacas
        foreach($datosReserva as $butaca){
            $but['reserva_id'] = $id;
            $but['fila'] = substr($butaca, 1, 1);
            $but['columna'] = explode('C', $butaca)[1];
            Butacas::insert($but);
        }
        
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
        //Recogemos los datos de la peticion para mostrar
        $peticion = request()->all();

        //Dependiendo de la informacion entregada en la peticion
        //se realizan diferentes busquedas de reservas
        if (($peticion['fecha']) != null && ($peticion['usuario']) != null){
            $reservas['reservas'] =Reservas::where('fecha', '=', $peticion['fecha'])
            ->where('usuario_id', '=', $peticion['usuario'])
            ->get();
        }elseif ($peticion['fecha']!=null){
            $reservas['reservas'] =Reservas::where('fecha', '=', $peticion['fecha'])
            ->get();
        }elseif ($peticion['usuario']!=null){
            $reservas['reservas'] =Reservas::where('usuario_id', '=', $peticion['usuario'])
            ->get();
        }else{
            return redirect('reservas')->with('mensaje','No se ha elegido ningun criterio de busqueda');
        }

        //Se consiguen para cada reserva las butacas asignadas
        foreach($reservas['reservas'] as $reserva){
            $cantbutacas = 0;
            //$reserva['usuario_nombre'] = User::where('id', '=', $reserva['usuario_id'])[0]->nombre;
            $reserva['usuario_nombre'] = User::findOrFail($reserva['usuario_id'])->nombre;
            $reserva['email'] = User::findOrFail($reserva['usuario_id'])->email;
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
        //TODO: Editar reservas
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
        //TODO: Editar reservas
        return view('reservas.update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservas  $reservas
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Eliminamos la reserva y las butacas asignadas a ellas gracias a la relacion de la pk con las fk
        Reservas::destroy($id);
        return redirect('reservas')->with('mensaje','Reserva borrada correctamente');
    }

    public function consultar(){
        //Recogemos los datos de la peticion para mostrar correctamente en la vista consultar
        $datos['fechaformat'] = request()->get('_fechaformat');
        $datos['users'] = User::all();
        return view('reservas.consultar', $datos);
    }
}
