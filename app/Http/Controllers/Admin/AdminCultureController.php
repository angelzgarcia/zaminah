<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCulturaRequest;
use App\Http\Requests\UpdateCultureRequest;
use App\Models\Cultura;
use Illuminate\Support\Facades\Storage;

class AdminCultureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $culturas = Cultura::orderBy('idCultura', 'desc') -> paginate();
        // return $culturas;
        return view('admin.cultures.index', compact('culturas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cultures.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCulturaRequest $request)
    {
        $culture = new Cultura();
        $culture -> nombre = $request -> nombre;
        $culture -> periodo = $request -> periodo;
        $culture -> significado = $request -> significado;
        $culture -> descripcion = $request -> descripcion;
        if ($request->hasFile('foto')) {
            $culture -> foto = basename($request -> file('foto')->store('img/uploads', 'public'));
        }

        $culture -> aportaciones = $request -> aportaciones;


        $culture -> save();

        return redirect() -> route('admin.cultures.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $culture = Cultura::where('idCultura', $id) -> first();

        return view('admin.cultures.show', compact('culture'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $culture = Cultura::where('idCultura', $id) -> first();

        return view('admin.cultures.edit', compact('culture'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCultureRequest $request, $id)
    {
        $culture = Cultura::where('idCultura', $id) -> first();

        if ($request -> hasFile('foto')) {
            $oldImage = $culture -> foto;
            if ($oldImage && Storage::disk('public')->exists("img/uploads/{$oldImage}")) {
                Storage::disk('public')->delete("img/uploads/{$oldImage}");
            }
            $culture -> foto = basename($request -> file('foto') -> store('img/uploads', 'public'));
        }
        $culture -> nombre = $request -> nombre;
        $culture -> periodo = $request -> periodo;
        $culture -> significado  = $request -> significado;
        $culture -> descripcion = $request -> descripcion;
        $culture -> aportaciones = $request -> aportaciones;

        $culture -> update();

        return redirect() -> route('admin.cultures.show', $culture->idCultura);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
