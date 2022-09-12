<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use routes\web;
use Illuminate\Support\Facades\Route;
use Redirect;

class EmpleadoController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        //
    }
    public function index()
    {
        $saludo = 'Bienvenid@a';
        $empleados=Empleado::all();
        $info = 0;
        $promedio = self::calcularPromedioDeEdades();
        if($promedio['contador4']>0)
        {
            $info = 1;
        }
        else
        {
            $info = 2;
        }
        //Uso de Array
        $data = array(
            //Función de Cadena
            'saludo' => str_repeat($saludo,1),
            'promedio' => self::calcularPromedioDeEdades(),
            'info' => $info
        );
        return view('empleado/index',compact('empleados'))->with($data); 
    }

    public function create(Request $request)
    {
        Empleado::create($request->except('updated_at','created_at'));
        return Redirect::to('/');
    }
    public function destroy(Request $request)
    {
        Empleado::destroy($request->post('idD'));
        return Redirect::to('/');
    }
    public function edit(Request $request)
    {
        $id = $request->post('id');
        $empleado = Empleado::findOrFail($id);
        $empleado -> nombre = $request->post('nombre');
        $empleado -> apellido = $request->post('apellido');
        $empleado -> edad = $request->post('edad');
        $empleado -> update();
        return Redirect::to('/');
    }
    public function calcularPromedioDeEdades()
    {
        $acumulador = 0;
        $promedio = 0;
        $contador = 0;
        $contador2 = 0;
        $contador3 = 0;
        $contador4 = -1;
        $empleados = Empleado::all();
        foreach ($empleados as $empleado)
        {
            $acumulador += $empleado -> edad;
            $contador += 1;
        }
        for ($i = 1; $i <= $contador; $i++) {
            $contador2 +=1;
        }
        while($contador2 != $contador3){
            $contador3 +=1;
        }
        do {
            $contador4 +=1;
        } while ($contador4 < $contador3);
        if($contador > 0)
        {
            $promedio = $acumulador / $contador;
        }
        $data = array
        (
            'contador1' => $contador,
            'contador2' => $contador2,
            'contador3' => $contador3,
            'contador4' => $contador4,
            'promedio' => round($promedio)
        );
        return $data;
    }
}
