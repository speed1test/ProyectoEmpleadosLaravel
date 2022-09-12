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
        $empleados=Empleado::all();
        return view('empleado/index',compact('empleados')); 
    }

    public function create(Request $request)
    {
        /*$datosEmpleado = request()->except('_token');
        Empleado::insert($datosEmpleado);*/
        //$datosEmpleado = request();
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
        //$empleado = new Empleado();
        $empleado = Empleado::findOrFail($id);
        $empleado -> nombre = $request->post('nombre');
        $empleado -> apellido = $request->post('apellido');
        $empleado -> edad = $request->post('edad');
        $empleado -> update();
        return Redirect::to('/');

    }
}
