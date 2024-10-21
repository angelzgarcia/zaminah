@extends('layouts.main-admin')

@section('src-maps')
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIpIISAV4iA4HQYpwSDnBpgVe2iQFKYig&loading=async&libraries=places&callback=initMap"></script>
    <script type="module" src="https://unpkg.com/@googlemaps/extended-component-library@0.6"></script>
@endsection

@section('titulo', 'Añadir zona | INAH')

@section('admin-content')
    <form action="{{route('admin.zones.store')}}" method="POST" autocomplete="off" enctype="multipart/form-data" onload="initMap()">
        @csrf

        <h2>Agrega una zona arqueologica</h2>
        <fieldset>
            <legend>Nombre</legend>
            <input type="text" name="nombre" value="{{old('nombre')}}">
            @error ('nombre')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Significado</legend>
            <textarea name="significado" id="" cols="30" rows="10">{{old('significado')}}</textarea>
            @error ('significado')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Descripcion</legend>
            <textarea name="descripcion" id="" cols="30" rows="10">{{old('descripcion')}}</textarea>
            @error ('descripcion')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Acceso</legend>
            <textarea name="acceso" id="" cols="30" rows="10">{{old('acceso')}}</textarea>
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
            <input type="time" id="hora" name="de_hora" value="{{old('de_hora')}}">
            @error ('de_hora')
                <div class="error">{{$message}}</div>
            @enderror

            <label for="a_hora">a las:</label>
            <input type="time" id="hora" name="a_hora" value="{{old('a_hora')}}">
            @error ('a_hora')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Costo de la entrada</legend>
            <span><strong><em>$</em> </strong></span><input type="text" name="costo" maxlength="4" value="{{old('costo')}}">
            @error ('costo')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Contacto</legend>
            <textarea name="contacto" id="" cols="30" rows="10">{{old('contacto')}}</textarea>
            @error ('contacto')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>¿En qué estado de la República Mexicana se encuentra?</legend>
            <select name="estado" id="estado">
                <option value="" selected disabled>Selecciona un estado</option>
                @foreach ($states as $state)
                    <option value="{{$state->idEstadoRepublica}}"
                        {{old('estado') == $state->idEstadoRepublica ? 'selected' : ''}}>
                        {{$state->nombre}}
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
                    <option value="" disabled selected>Selecciona una cultura</option>
                    @foreach ($cultures as $cult)
                        <option value="{{$cult->idCultura}}"
                            {{old('cultura') == $cult->idCultura ? 'selected' : ''}}>
                            {{$cult->nombre}}
                        </option>
                    @endforeach
            </select>
            @error ('cultura')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Fotos <small>(minimo 2, maximo 4)</small></legend>
            <input type="file" name="fotos[]" id="fotos[]" multiple accept="image/*">
            @error ('fotos')
                <div class="error">{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Direccion</legend>
            <input type="text" name="direccion" id="direccion" style="width: 100%">
            <input type="hidden" name="latitud"  id="latitud" required disabled>
            <input type="hidden" name="longitud" id="longitud" required disabled>
            <div id="info-box"></div>
            <div id="map" style="width: 100%; height: 500px;"> </div>
        </fieldset>

        <button type="submit">Guardar</button>
    </form>
@endsection

@section('js')
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

            mexico = { lat: 23.6345, lng: -102.5528 };
            geocoder = new google.maps.Geocoder();

            map = new google.maps.Map(
                document.getElementById('map'), {
                    zoom: 6,
                    center: mexico,
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
                                "color": "#ebe3cd"
                            }
                            ]
                        },
                        {
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#523735"
                            }
                            ]
                        },
                        {
                            "elementType": "labels.text.stroke",
                            "stylers": [
                            {
                                "color": "#f5f1e6"
                            }
                            ]
                        },
                        {
                            "featureType": "administrative",
                            "elementType": "geometry.stroke",
                            "stylers": [
                            {
                                "color": "#c9b2a6"
                            }
                            ]
                        },
                        {
                            "featureType": "administrative.land_parcel",
                            "elementType": "geometry.stroke",
                            "stylers": [
                            {
                                "color": "#dcd2be"
                            }
                            ]
                        },
                        {
                            "featureType": "administrative.land_parcel",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#ae9e90"
                            }
                            ]
                        },
                        {
                            "featureType": "landscape.natural",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#dfd2ae"
                            }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#dfd2ae"
                            }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#93817c"
                            }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "geometry.fill",
                            "stylers": [
                            {
                                "color": "#a5b076"
                            }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#447530"
                            }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#f5f1e6"
                            }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#fdfcf8"
                            }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#f8c967"
                            }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry.stroke",
                            "stylers": [
                            {
                                "color": "#e9bc62"
                            }
                            ]
                        },
                        {
                            "featureType": "road.highway.controlled_access",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#e98d58"
                            }
                            ]
                        },
                        {
                            "featureType": "road.highway.controlled_access",
                            "elementType": "geometry.stroke",
                            "stylers": [
                            {
                                "color": "#db8555"
                            }
                            ]
                        },
                        {
                            "featureType": "road.local",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#806b63"
                            }
                            ]
                        },
                        {
                            "featureType": "transit.line",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#dfd2ae"
                            }
                            ]
                        },
                        {
                            "featureType": "transit.line",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#8f7d77"
                            }
                            ]
                        },
                        {
                            "featureType": "transit.line",
                            "elementType": "labels.text.stroke",
                            "stylers": [
                            {
                                "color": "#ebe3cd"
                            }
                            ]
                        },
                        {
                            "featureType": "transit.station",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#dfd2ae"
                            }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "geometry.fill",
                            "stylers": [
                            {
                                "color": "#b9d3c2"
                            }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#92998d"
                            }
                            ]
                        }
                        ]
                }
            );

            marker = new google.maps.Marker({
                position: mexico,
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
                    marker.setPosition(mexico);
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
