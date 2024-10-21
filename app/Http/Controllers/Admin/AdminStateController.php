<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStateRequest;
use App\Http\Requests\UpdateStateRequest;
use App\Models\UbicacionEstado;
use App\Models\Estado;

class AdminStateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $states = new Estado();
        $states = Estado::orderBy('nombre', 'asc') -> paginate();

        return view('admin.estados.index', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.estados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStateRequest $request)
    {
        $state = new Estado();
        $state -> nombre = $request -> nombre;
        $state -> capital = $request -> capital;
        $state -> video = $request -> video;
        $foto = $request -> hasFile('foto');
        $guia = $request -> hasFile('guia');
        $triptico = $request -> hasFile('triptico');

        if ($foto){
            $foto_name = $request -> file('foto') -> getClientOriginalName();
            $state -> foto = basename($request -> file('foto') -> storeAs('img/uploads', time() . '-' .$foto_name, 'public'));
        }

        if ($guia) {
            $guia_name = $request -> file('guia') -> getClientOriginalName();
            $state -> guia = basename($request -> file('guia') -> storeAs('guias', time() . '-' . $guia_name, 'public'));
        }

        if ($triptico) {
            $triptico_name = $request -> file('triptico') -> getClientOriginalName();
            $state -> triptico = basename($request -> file('triptico') -> storeAs('tripticos',  time() . '-' . $triptico_name, 'public'));
        }

        $coords = getCoordinates($request->nombre);
        if (!$coords) {
            return redirect()
                    -> back()
                    -> withInput()
                    -> withErrors(['nombre' => 'No existen coordenadas para el nombre del estado ingresado']);
        }

        $location = new UbicacionEstado();
        $location -> latitud = $coords['lat'];
        $location -> longitud = $coords['lng'];

        $state -> save();
        $location -> idEstadoRepublica = $state -> idEstadoRepublica;
        $location -> save();

        return redirect() -> route('admin.estados.show', compact('state'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Estado $state)
    {
        if (!$state)
            return redirect() -> route('admin.estados.index');

        return view('admin.estados.show', compact('state'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estado $state)
    {
        if (!$state)
            return redirect() -> route('admin.estados.index');

        return view('admin.estados.edit', compact('state'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStateRequest $request, Estado $state)
    {
        $state -> nombre = $request -> nombre;
        $state -> capital = $request -> capital;
        $state -> video = $request -> video;
        $foto = $request -> hasFile('foto');
        $guia = $request -> hasFile('guia');
        $triptico = $request -> hasFile('triptico');

        if ($foto){
            $foto_name = $request -> file('foto') -> getClientOriginalName();
            $state -> foto = basename($request -> file('foto') -> storeAs('img/uploads', time() . '-' .$foto_name, 'public'));
        }

        if ($guia) {
            $guia_name = $request -> file('guia') -> getClientOriginalName();
            $state -> guia = basename($request -> file('guia') -> storeAs('guias', time() . '-' . $guia_name, 'public'));
        }

        if ($triptico) {
            $triptico_name = $request -> file('triptico') -> getClientOriginalName();
            $state -> triptico = basename($request -> file('triptico') -> storeAs('tripticos',  time() . '-' . $triptico_name, 'public'));
        }

        $coords = getCoordinates($request->nombre);
        if (!$coords) {
            return redirect()
                    -> back()
                    -> withInput()
                    -> withErrors(['nombre' => 'No existen coordenadas para el estado ingresado']);
        }

        $location = UbicacionEstado::where('idEstadoRepublica', $state -> idEstadoRepublica) -> first();
        $location -> latitud = $coords['lat'];
        $location -> longitud = $coords['lng'];

        $state -> update();
        $location -> idEstadoRepublica = $state -> idEstadoRepublica;
        $location -> update();

        return redirect() -> route('admin.estados.show', compact('state'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estado $state)
    {
        $state -> delete();
        return redirect() -> route('admin.estados.index');
    }
}
