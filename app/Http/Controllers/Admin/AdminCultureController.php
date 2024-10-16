<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCulturaRequest;
use App\Http\Requests\UpdateCultureRequest;
use App\Models\Cultura;
use App\Models\CulturaImagen;
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
        $culture -> aportaciones = $request -> aportaciones;
        $culture -> save();

        if ($request->hasFile('fotos'))
            foreach($request -> file('fotos') as $foto) {
                $cultureImage = new CulturaImagen();
                $cultureImage -> foto = basename(time() .'-'. $foto -> store('img/uploads', 'public'));
                $cultureImage -> idCultura = $culture -> idCultura;
                $cultureImage -> save();
            }

        return redirect() -> route('admin.cultures.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $culture = Cultura::with('fotos') -> where('idCultura', $id) -> first();
        $culture = Cultura::where('idCultura', $id) -> first();

        if (!$culture)
            return redirect() -> route('admin.cultures.index');

        return view('admin.cultures.show', compact('culture'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $culture = Cultura::where('idCultura', $id) -> first();
        $img_cnt = count($culture->fotos);

        if (!$culture)
            return redirect() -> route('admin.cultures.index');

        return view('admin.cultures.edit', compact('culture', 'img_cnt'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCultureRequest $request, $id)
    {
        // $culture = Cultura::where('idCultura', $id) -> first();
        if ($request->hasFile('imgs_actuales_ids')) {
            foreach ($request->file('imgs_actuales_ids') as $idCulturaFoto => $files) {
                    echo "CulturaFoto ID: $idCulturaFoto ---- Archivo: $files";
            }
        }


        // $culture -> nombre = $request -> nombre;
        // $culture -> periodo = $request -> periodo;
        // $culture -> significado  = $request -> significado;
        // $culture -> descripcion = $request -> descripcion;
        // $culture -> aportaciones = $request -> aportaciones;

        // if ($request -> hasFile('foto')) {
        //     if ($culture -> foto && Storage::disk('public')->exists("img/uploads/{$culture -> foto}"))
        //         Storage::disk('public')->delete("img/uploads/{$culture -> foto}");

        //     $culture -> foto = basename(time() .'-'. $request -> file('foto') -> store('img/uploads', 'public'));
        // }

        // $culture -> update();

        // return redirect() -> route('admin.cultures.show', $culture->idCultura);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
