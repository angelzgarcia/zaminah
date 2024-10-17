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

    public function storeImg($imgs_arr_name, $request, $culture) {
        if ($request->hasFile($imgs_arr_name))
            foreach($request -> file($imgs_arr_name) as $foto) {
                $cultureImage = new CulturaImagen();
                $cultureImage -> foto = basename(time() .'-'. $foto -> store('img/uploads', 'public'));
                $cultureImage -> idCultura = $culture -> idCultura;
                $cultureImage -> save();
            }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCulturaRequest $request)
    {
        // $culture = new Cultura();
        // $culture -> nombre = $request -> nombre;
        // $culture -> periodo = $request -> periodo;
        // $culture -> significado = $request -> significado;
        // $culture -> descripcion = $request -> descripcion;
        // $culture -> aportaciones = $request -> aportaciones;
        // $culture -> save();
        $culture = new Cultura();
        $culture = Cultura::create($request -> all());

        $this->storeImg('fotos', $request, $culture);

        return redirect() -> route('admin.cultures.show', $culture);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cultura $culture)
    {
        // $culture = Cultura::with('fotos') -> where('idCultura', $id) -> first();
        // $culture = Cultura::where('idCultura', $id) -> first();

        if (!$culture)
            return redirect() -> route('admin.cultures.index');

        return view('admin.cultures.show', compact('culture'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cultura $culture)
    {
        // $culture = Cultura::where('idCultura', $id) -> first();
        $img_cnt = count($culture->fotos);

        if (!$culture)
            return redirect() -> route('admin.cultures.index');

        return view('admin.cultures.edit', compact('culture', 'img_cnt'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCultureRequest $request, Cultura $culture)
    {
        // $culture = Cultura::where('idCultura', $id) -> first();
        $id = $culture -> idCultura;

        // $culture -> nombre = $request -> nombre;
        // $culture -> periodo = $request -> periodo;
        // $culture -> significado  = $request -> significado;
        // $culture -> descripcion = $request -> descripcion;
        // $culture -> aportaciones = $request -> aportaciones;
        $culture -> update($request -> all());

        $to_eliminate_imgs = $request->to_eliminate_imgs;
        $current_imgs_dec = $request->current_imgs_dec;
        $new_imgs = $request -> new_imgs;

        // ACTUALIZAR FOTOS
        if ($current_imgs_dec):
            foreach ($current_imgs_dec as $hash_id => $id_unhash):
                $hash_id_value = hash_img($id_unhash);
                if ($hash_id != $hash_id_value):
                    return redirect()
                            -> back()
                            -> with('error', 'a donde vas wei');
                elseif ($request -> hasFile('current_imgs_'.$hash_id)):
                        $img_culture = CulturaImagen::where('idCulturaFoto', $id_unhash)->first();
                        Storage::disk('public') -> delete("img/uploads/{$img_culture -> foto}");
                        $img_culture -> foto = basename(time() . '-' . $request -> file('current_imgs_'.$hash_id) -> store('img/uploads', 'public'));
                        $img_culture -> save();
                endif;
            endforeach;
        endif;


        // AÑADIR MAS IMAGENES
        if ($new_imgs):
            $count_current_imgs = CulturaImagen::where('idCultura', $id) -> count();
            $count_new_imgs = count($new_imgs);
            // VALIDAR MAXIMO DE IMAGENES
            if (($count_current_imgs > 3) || ($count_current_imgs + $count_new_imgs > 4)):
                return redirect()
                        -> back()
                        -> withInput()
                        -> withErrors(['new_imgs' => 'Solo se permiten 4 imagenes como máximo']);
            else:
                $this -> storeImg('new_imgs', $request, $culture);
            endif;
        endif;


        // ELIMINAR FOTOS
        if ($to_eliminate_imgs):
            $image = CulturaImagen::where('idCultura', $id) -> count();
            $count_elim = count($to_eliminate_imgs);
            // VALIDAR MINIMO DE IMAGENES
            if (($image == $count_elim) || ($image - $count_elim < 2)):
                return redirect()
                        -> back()
                        -> withInput()
                        -> withErrors(['to_eliminate_imgs' => 'Debes dejar al menos 2 imagenes']);
            else:
                // BORRAR FOTOS SELECCIONADAS
                foreach($to_eliminate_imgs as $enc_id => $id_img):
                    if ($enc_id != hash_img($id_img)):
                        return redirect()
                                -> back()
                                -> with('error', 'nel perro');
                    else:
                        $image = CulturaImagen::where('idCulturaFoto', $id_img) -> first();
                        Storage::disk('public')->delete("img/uploads/$image->foto");
                        $image -> where('idCulturaFoto', $id_img) -> delete() ;
                    endif;
                endforeach;
            endif;
        endif;

        // $culture -> update();

        return redirect() -> route('admin.cultures.show', $culture->idCultura);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cultura $culture)
    {
        $culture -> delete();
        return redirect() -> route('admin.cultures.index');
    }
}
