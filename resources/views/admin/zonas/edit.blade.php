@extends('layouts.main-admin')

@section('src-maps')
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIpIISAV4iA4HQYpwSDnBpgVe2iQFKYig&loading=async&libraries=places&callback=initMap"></script>
    <script type="module" src="https://unpkg.com/@googlemaps/extended-component-library@0.6"></script>
@endsection

@section('titulo', 'Editar zona | INAH')

@section('admin-content')

    <form action="{{route('admin.zonas.update', $zone)}}" method="post" autocomplete="off" enctype="multipart/form-data" onload="initMap()">
        @csrf
        @method('put')

        <h2>Editar zona arqueológica {{$zone->nombre}}</h2>
        <fieldset>
            <legend>Nombre</legend>
            <input type="text" name="nombre" value="{{old('nombre', $zone->nombre)}}">
            @error ('nombre')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Significado</legend>
            <textarea name="significado" id="" cols="30" rows="10">{{old('significado', $zone->significado)}}</textarea>
            @error ('significado')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Descripcion</legend>
            <textarea name="descripcion" id="" cols="30" rows="10">{{old('descripcion', $zone->descripcion)}}</textarea>
            @error ('descripcion')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Acceso</legend>
            <textarea name="acceso" id="" cols="30" rows="10">{{old('acceso', $zone->acceso)}}</textarea>
            @error ('acceso')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Horario</legend>
            <label for="de_dia">De:</label>
            <select name="de_dia" id="de_dia" value="{{old('de_dia')}}">
                <option value="Lunes">Lunes</option>
                <option value="Martes">Martes</option>
                <option value="Miercoles">Miercoles</option>
                <option value="Jueves">Jueves</option>
                <option value="Viernes">Viernes</option>
                <option value="Sabado">Sabado</option>
                <option value="Domingo">Domingo</option>
            </select>
            @error ('de_dia')
                <div class="error">{{$message}}</div>
            @enderror

            <label for="a_dia">a:</label>
            <select name="a_dia" id="a_dia" value="{{old('a_dia')}}">
                <option value="Domingo">Domingo</option>
                <option value="Lunes">Lunes</option>
                <option value="Martes">Martes</option>
                <option value="Miercoles">Miercoles</option>
                <option value="Jueves">Jueves</option>
                <option value="Viernes">Viernes</option>
                <option value="Sabado">Sabado</option>
            </select>
            @error ('a_dia')
                <div class="error">{{$message}}</div>
            @enderror

            <br><br>
            <label for="de_hora">De las:</label>
            <input type="time" id="hora" name="de_hora" value="{{$de_hora}}">
            @error ('de_hora')
                <div class="error">{{$message}}</div>
            @enderror

            <label for="a_hora">a las:</label>
            <input type="time" id="hora" name="a_hora" value="{{$a_hora}}">
            @error ('a_hora')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Costo de la entrada</legend>
            <span><strong><em>$</em> </strong></span><input type="text" name="costo" maxlength="4" value="{{old('costo', $zone->costoEntrada)}}">
            @error ('costo')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>
            <textarea name="contacto" id="" cols="30" rows="10">{{old('contacto', $zone->contacto)}}</textarea>
            @error ('contacto')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>¿En qué estado de la República Mexicana se encuentra?</legend>
            <select name="estado" id="estado">
                @foreach ($states as $state)
                    <option value="{{ $state->idEstadoRepublica }}"
                        {{ old('estado', $current_state->idEstadoRepublica) == $state->idEstadoRepublica ? 'selected' : '' }}>
                        {{ $state->nombre }}
                    </option>
                @endforeach
            </select>
            @error ('estado')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>¿A qué cultura perteneció esta Zona Arqueológica?</legend>
            <select name="cultura" id="cultura">
                    @foreach ($cultures as $cult)
                        <option value="{{$cult->idCultura}}"
                            {{old('cultura', $current_culture->idCultura) == $cult->idCultura ? 'selected' : ''}}>
                            {{$cult->nombre}}
                        </option>
                    @endforeach
            </select>
            @error ('cultura')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Fotos</small></legend>
            @foreach ($zone->fotos as $img)
                <label for="up_img">Actualizar imagen</label>
                <input type="hidden" name="current_imgs_dec[{{hash_img($img->idZonaFoto)}}]" value="{{$img->idZonaFoto}}">
                <input type="file" name="current_imgs_{{hash_img($img->idZonaFoto)}}" accept="image/*">

                <input type="checkbox" name="to_eliminate_imgs[{{hash_img($img->idZonaFoto)}}]" value="{{$img->idZonaFoto}}" id="" onchange="crrnt_imgs_disables('{{hash_img($img->idZonaFoto)}}')"> Eliminar imagen

                <div> <img src="{{img_u_url($img->foto)}}" width="300px" alt="zona-arqueologica"> </div>
            @endforeach
            @error ('current_imgs_*') <div class="error">{{$message}}</div> @enderror
            @error ('to_eliminate_imgs') <div class="error">{{$message}}</div> @enderror
            @error ('new_imgs') <div class="error">{{$message}}</div> @enderror
        </fieldset>

        @if ($img_zone_count < 4)
            <fieldset>
                <legend>Añadir fotos <small>(minimo 2, maximo 4)</legend>
                <input type="file" name="new_imgs[]" multiple accept="image/*">
            </fieldset>
        @endif

        <fieldset>
            <legend>Direccion</legend>
            <input type="text" name="direccion" id="direccion" style="width: 100%">
            <input type="hidden" name="latitud"  id="latitud"  value="{{$location->latitud}}" required disabled>
            <input type="hidden" name="longitud" id="longitud" value="{{$location->longitud}}" required disabled>
            <div id="info-box"></div>
            <div id="map" style="width: 100%; height: 500px;"> </div>
        </fieldset>

        <button type="submit">Guardar</button>
    </form>

@endsection

@section('js')
    {{-- VALIDACION DE CHECKBOXES --}}
    <script>
        function crrnt_imgs_disables(img) {
            var fileInput = document.querySelector(`input[name="current_imgs_${img}"]`);
            var checkbox = document.querySelector(`input[name="to_eliminate_imgs[${img}]"]`);

            checkbox.checked ? fileInput.disabled = true : fileInput.disabled = false;
        }
    </script>

    {{-- MAPS --}}
    <script>
        let map;
        let marker;
        let geocoder;
        let infowindow;

        function initMap() {
            const bounds = new google.maps.LatLngBounds(
                new google.maps.LatLng(14.5329, -118.4544),
                new google.maps.LatLng(32.7160, -86.7034)
            );

            let lat = parseFloat(document.getElementById('latitud').value);
            let lng = parseFloat(document.getElementById('longitud').value);

            zona = { lat: lat, lng: lng };
            geocoder = new google.maps.Geocoder();

            map = new google.maps.Map(
                document.getElementById('map'), {
                    zoom: 6,
                    center: zona,
                    mapTypeControl: true,
                    scrollwheel: false,
                    restriction: {
                        latLngBounds: bounds,
                        strictBounds: true,
                    },
                    mapTypeControlOptions: {
                        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                        position: google.maps.ControlPosition.TOP_CENTER,
                    },
                    zoomControl: true,
                    zoomControlOptions: {
                        position: google.maps.ControlPosition.LEFT_CENTER,
                    },
                    scaleControl: true,
                    streetViewControl: true,
                    streetViewControlOptions: {
                        position: google.maps.ControlPosition.LEFT_TOP,
                    },
                    fullscreenControl: true,
                    gestureHandling: 'greedy',
                    styles: [
                        {
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#1d2c4d"
                            }
                            ]
                        },
                        {
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#8ec3b9"
                            }
                            ]
                        },
                        {
                            "elementType": "labels.text.stroke",
                            "stylers": [
                            {
                                "color": "#1a3646"
                            }
                            ]
                        },
                        {
                            "featureType": "administrative.country",
                            "elementType": "geometry.stroke",
                            "stylers": [
                            {
                                "color": "#4b6878"
                            }
                            ]
                        },
                        {
                            "featureType": "administrative.land_parcel",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#64779e"
                            }
                            ]
                        },
                        {
                            "featureType": "administrative.province",
                            "elementType": "geometry.stroke",
                            "stylers": [
                            {
                                "color": "#4b6878"
                            }
                            ]
                        },
                        {
                            "featureType": "landscape.man_made",
                            "elementType": "geometry.stroke",
                            "stylers": [
                            {
                                "color": "#334e87"
                            }
                            ]
                        },
                        {
                            "featureType": "landscape.natural",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#023e58"
                            }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#283d6a"
                            }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#6f9ba5"
                            }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "labels.text.stroke",
                            "stylers": [
                            {
                                "color": "#1d2c4d"
                            }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "geometry.fill",
                            "stylers": [
                            {
                                "color": "#023e58"
                            }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#3C7680"
                            }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#304a7d"
                            }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#98a5be"
                            }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "labels.text.stroke",
                            "stylers": [
                            {
                                "color": "#1d2c4d"
                            }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#2c6675"
                            }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry.stroke",
                            "stylers": [
                            {
                                "color": "#255763"
                            }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#b0d5ce"
                            }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "labels.text.stroke",
                            "stylers": [
                            {
                                "color": "#023e58"
                            }
                            ]
                        },
                        {
                            "featureType": "transit",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#98a5be"
                            }
                            ]
                        },
                        {
                            "featureType": "transit",
                            "elementType": "labels.text.stroke",
                            "stylers": [
                            {
                                "color": "#1d2c4d"
                            }
                            ]
                        },
                        {
                            "featureType": "transit.line",
                            "elementType": "geometry.fill",
                            "stylers": [
                            {
                                "color": "#283d6a"
                            }
                            ]
                        },
                        {
                            "featureType": "transit.station",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#3a4762"
                            }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#0e1626"
                            }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#4e6d70"
                            }
                            ]
                        }
                        ]
                }
            );

            marker = new google.maps.Marker({
                position: zona,
                map: map,
                draggable: true,
            });

            infoBox = document.getElementById("info-box");

            getAddressFromCoordinates(marker.getPosition());

            google.maps.event.addListener(marker, 'dragend', function() {
                if (!bounds.contains(marker.getPosition())) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        iconColor: 'white',
                        customClass: {
                            popup: 'colored-toast',
                        },
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                        });
                        Toast.fire({
                        icon: "warning",
                        title: "Fuera de los límites de la Reública Mexicana"
                    });
                    marker.setPosition(zona);
                }
                const latLng = marker.getPosition();
                updateInputs(latLng);
                getAddressFromCoordinates(latLng);
            });

            const input = document.getElementById("direccion");
            const autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo("bounds", map);
            input.addEventListener('keydown', function(event){
                if (event.key == 'Enter') {
                    event.preventDefault();
                }
            })

            autocomplete.addListener("place_changed", function () {
                const place = autocomplete.getPlace();
                if (!place.geometry) {
                    return;
                }

                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                }

                marker.setPosition(place.geometry.location);
                updateInputs(place.geometry.location);
            });

            map.addListener('dblclick', (event) => {
                const latLng = event.latLng;

                marker.setPosition(latLng);

                document.getElementById('latitud').value = latLng.lat();
                document.getElementById('longitud').value = latLng.lng();

                updateInputs(latLng);
                getAddressFromCoordinates(latLng);
            });
        }

        function updateInputs(latLng) {
            document.getElementById("latitud").value = latLng.lat();
            document.getElementById("longitud").value = latLng.lng();
        }

        function getAddressFromCoordinates(latLng) {
            geocoder.geocode({ location: latLng }, function(results, status) {
                if (status === "OK") {
                    if (results[0]) {
                        document.getElementById("direccion").value = results[0].formatted_address;
                        const lat = latLng.lat();
                        const lng = latLng.lng();

                        // infoBox.style.display = 'flex';
                        infoBox.innerHTML = `
                            <div class="info-title">Coordenadas:</div>
                            <div class="info-content">Latitud: ${lat}<br>Longitud: ${lng}</div>`;
                        } else {
                            window.alert("No se encontraron resultados.");
                        }
                    } else {
                        window.alert("Error en Geocoder: " + status);
                    }
            });
        }
    </script>
@endsection
