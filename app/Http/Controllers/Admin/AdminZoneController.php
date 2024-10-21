<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use \Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreZoneRequest;
use App\Http\Requests\UpdateZoneRequest;
use App\Models\Cultura;
use App\Models\CulturaEstado;
use App\Models\Estado;
use App\Models\UbicacionZona;
use App\Models\ZonaImagen;
use App\Models\Zona;

class AdminZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $zones = Zona::orderBy('idZonaArqueologica', 'desc') -> paginate();
        return view('admin.zonas.index', compact('zones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Estado $states, Cultura $cultures)
    {
        $states = Estado::orderBy('nombre', 'asc') -> get();
        $cultures = Cultura::orderBy('nombre', 'asc') -> get();

        return view('admin.zonas.create', compact('states', 'cultures'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreZoneRequest $request)
    {
        $zone = new Zona();

        $de_dia = $request -> de_dia;
        $a_dia = $request -> a_dia;
        $de_hora = $request-> de_hora;
        $a_hora = $request -> a_hora;

        $tiempo_de_hora = $de_hora <= 12 ? 'a.m.' : 'p.m.';
        $tiempo_a_hora = $a_hora <= 12 ? 'a.m.' : 'p.m.';

        $horario = "De $de_dia a $a_dia de las $de_hora $tiempo_de_hora a las $a_hora $tiempo_a_hora";

        $zone -> nombre = $request -> nombre;
        $zone -> significado = $request -> significado;
        $zone -> descripcion = $request -> descripcion;
        $zone -> acceso = $request -> acceso;
        $zone -> horario = $horario;
        $zone -> costoEntrada = $request -> costo;
        $zone -> contacto = $request -> contacto;
        $zone -> idEstadoRepublica = $request -> estado;
        $zone -> idCultura = $request -> cultura;

        if ($request -> hasFile('fotos')) {
            foreach ($request -> file('fotos') as $img) {
                $zonaFotos = new ZonaImagen();
                $zonaFotos -> foto = basename(time() . '-' . $img -> store('img/uploads', 'public'));
                $zone -> save();
                $zonaFotos -> idZonaArqueologica = $zone -> idZonaArqueologica;
                $zonaFotos -> save();
            }

            $ubicacion = new UbicacionZona();

            $direccion = $request -> direccion;
            $coordenadas = getCoordinates($direccion);
            $ubicacion -> latitud = $coordenadas['lat'];
            $ubicacion -> longitud = $coordenadas['lng'];
            $ubicacion -> idZonaArqueologica = $zone -> idZonaArqueologica;
            $ubicacion -> save();


            $culture_state = new CulturaEstado();

            $culture_state -> idCultura = $request -> cultura;
            $culture_state -> idEstadoRepublica = $request -> estado;
            $culture_state -> save();
        }

        return view('admin.zonas.show', compact('zone'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Zona $zone)
    {
        if (!$zone)
            return redirect() -> route('admin.zonas.index');

        return view('admin.zonas.show', compact('zone'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Zona $zone)
    {
        if (!$zone)
            return redirect() -> route('admin.zonas.index');

        $states = Estado::orderBy('nombre', 'asc') -> get();
        $cultures = Cultura::orderBy('nombre', 'asc') -> get();
        $img_zone_count = ZonaImagen::where('idZonaArqueologica', $zone->idZonaArqueologica) -> count();
        $current_state = Estado::select('idEstadoRepublica') -> where('idEstadoRepublica', $zone->idEstadoRepublica) -> first();
        $current_culture = Cultura::select('idCultura') -> where('idCultura', $zone->idCultura) -> first();
        $location = UbicacionZona::where('idZonaArqueologica', $zone->idZonaArqueologica) -> first();

        $horario = explode(' ', $zone->horario);
        for ($i = 0; $i < count($horario); $i++) $horario[$i];

        $de_hora = $horario[6];
        $a_hora = $horario[count($horario)-2];

        return view('admin.zonas.edit', compact('zone', 'states', 'cultures', 'current_state', 'current_culture', 'de_hora', 'a_hora', 'img_zone_count', 'location'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateZoneRequest $request, Zona $zone)
    {
        $zone -> nombre = $request -> nombre;
        $zone -> significado = $request -> significado;
        $zone -> descripcion = $request -> descripcion;
        $zone -> acceso = $request -> acceso;
        $zone -> costoEntrada = $request -> costo;
        $zone -> contacto = $request -> contacto;
        $zone -> idEstadoRepublica = $request -> estado;
        $zone -> idCultura = $request -> cultura;

        $zone -> update();

        $count_current_imgs = ZonaImagen::where('idZonaArqueologica', $zone -> idZonaArqueologica) -> count();

        // NUEVAS IMAGENES
        if ($request -> hasFile('new_imgs')):
            $count_new_imgs = $request -> new_imgs;
            $count_new_imgs = count($count_new_imgs);

            if (($count_current_imgs > 3) || ($count_current_imgs + $count_new_imgs > 4)):
                return redirect()
                        -> back()
                        -> withInput()
                        -> withErrors(['new_imgs' => 'Máximo 4 imagenes']);

            else:
                foreach($request -> file('new_imgs') as $foto) {
                    $zoneImg = new ZonaImagen();
                    $zoneImg -> foto = basename(time() .'-'. $foto -> store('img/uploads', 'public'));
                    $zoneImg -> idZonaArqueologica = $zone -> idZonaArqueologica;
                    $zoneImg -> save();
                }
            endif;
        endif;

        // ACTUALIZAR IMAGENES
        if ($request -> current_imgs_dec):
            foreach ($request -> current_imgs_dec as $id_enc => $id_dec):
                if ($id_enc != hash_img($id_dec)) {
                    return redirect()
                            -> back()
                            -> withInput()
                            -> withErrors(["current_imgs_$id_enc" => 'Hubo problemas al identificar la imagen']);

                } else if ($request -> hasFile("current_imgs_$id_enc")) {
                    $img_zone = ZonaImagen::where('idZonaFoto', $id_dec) -> first();
                    Storage::disk('public') -> delete("img/uploads/{$img_zone -> foto}");

                    $img_zone -> foto = basename(time() . '-' . $request -> file("current_imgs_$id_enc") -> store('img/uploads', 'public'));
                    $img_zone -> save();
                }
            endforeach;
        endif;

        // ELIMINAR IMAGENES
        if ($request -> hasFile('to_eliminate_imgs')):
            $count_eliminate_imgs = $request -> to_eliminate_imgs;
            $count_eliminate_imgs = count($count_eliminate_imgs);

            if (($count_current_imgs < 3) || ($count_current_imgs - $count_eliminate_imgs < 2)) {
                return redirect()
                        -> back()
                        -> withInput()
                        -> withErrors(['to_eliminate_imgs' => 'Al menos 2 imagenes deben permanecer']);
            }

            foreach ($request -> to_eliminate_imgs as $id_enc => $id_dec):
                if ($id_enc != hash_img($id_dec)) {
                    return redirect()
                            -> back()
                            -> withInput()
                            -> withErrors(["current_imgs_$id_enc" => 'Hubo problemas al identificar la imagen']);

                } else {
                    $zone_img = ZonaImagen::where('idZonaFoto', $id_dec) -> delete();
                    Storage::disk('public') -> delete("img/uploads/$zone_img -> foto");
                }
            endforeach;
        endif;

        $current_location = UbicacionZona::where('idZonaArqueologica', $zone->idZonaArqueologica) -> first();
        $direccion = $request -> direccion;
        $location = getCoordinates($direccion);

        $current_location -> latitud = $location['lat'];
        $current_location -> longitud = $location['lng'];

        $current_location -> update();

        $culture_state = CulturaEstado::where('idCultura', $request -> cultura) -> where('idEstadoRepublica', $request -> estado) -> first();
        $culture_state -> idCultura = $request -> cultura;
        $culture_state -> idEstado = $request -> estado;
        $culture_state -> save();

        return view('admin.zonas.show', compact('zone'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Zona $zone)
    {
        $zone -> delete();

        return redirect() -> route('admin.zonas.index');
    }
}
