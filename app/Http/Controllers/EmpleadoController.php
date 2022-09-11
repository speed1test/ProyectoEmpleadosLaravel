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
    /*public function index()
    {
        return view('empleado/index');   
    }*/

    public function create(Request $request)
    {
        /*$datosEmpleado = request()->except('_token');
        Empleado::insert($datosEmpleado);*/
        //$datosEmpleado = request();
        Empleado::create($request->except('updated_at','created_at'));
        return Redirect::to('/');
    }
}
