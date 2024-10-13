<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCulturaRequest;
use Illuminate\Http\Request;
use App\Models\Cultura;

class AdminCultureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $culturas = Cultura::orderBy('idCultura', 'desc') -> paginate();
        // return $culturas;
        return view('admin.culturas.index', compact('culturas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.culturas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCulturaRequest $request)
    {
        $cultura = new Cultura();
        $cultura -> nombre = $request -> nombre;
        $cultura -> periodo = $request -> periodo;
        $cultura -> significado = $request -> significado;
        $cultura -> descripcion = $request -> descripcion;
        if ($request->hasFile('foto'))
            $cultura -> foto = basename($request -> file('foto')->store('img/uploads', 'public'));
        else return "No se recibió ninguna imagen.";

        $cultura -> aportaciones = $request -> aportaciones;

        $cultura -> save();

        return redirect() -> route('admin.cultures.index') -> with('success', 'Cultura creada con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cultura = Cultura::where('idCultura', $id) -> first();

        return view('admin.culturas.show', compact('cultura'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $cultura = Cultura::where('idCultura', $id) -> first();

        return view('admin.culturas.edit', compact('cultura'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
