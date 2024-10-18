<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStateRequest;
use App\Http\Requests\UpdateStateRequest;
use Illuminate\Http\Request;
use App\Models\Estado;

class AdminStateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $states = new Estado();
        $states = Estado::orderBy('nombre', 'asc') -> get();

        return view('admin.states.index', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.states.create');
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

        $state -> save();

        return redirect() -> route('admin.states.show', compact('state'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Estado $state)
    {
        if (!$state)
            return redirect() -> route('admin.states.index');

        return view('admin.states.show', compact('state'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Estado $state)
    {
        if (!$state)
            return redirect() -> route('admin.states.index');

        return view('admin.states.edit', compact('state'));
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

        $state -> update();

        return redirect() -> route('admin.states.show', compact('state'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Estado $state)
    {
        $state -> delete();
        return redirect() -> route('admin.states.index');
    }
}
