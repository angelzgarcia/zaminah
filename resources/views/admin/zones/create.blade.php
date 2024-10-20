@extends('layouts.main-admin')

@section('src-maps')
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIpIISAV4iA4HQYpwSDnBpgVe2iQFKYig&loading=async&libraries=places&callback=initMap"></script>
    <script type="module" src="https://unpkg.com/@googlemaps/extended-component-library@0.6"></script>
@endsection

@section('titulo', 'Añadir zona | INAH')

@section('admin-content')
<style>

    #info-box {
        padding: 10px 0;
        display: flex;
        flex-direction: column;
        /* gap: .3em; */
        z-index: 100000;
        font-family: Arial, sans-serif;
    }

    /* Estilos adicionales para el contenido */
    .info-title {
        font-weight: bold;
    }

    .info-content {
        margin-top: 5px;
    }
</style>
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
                    <option value="{{$state->idEstadoRepublica}}" {{old('estado') == $state->idEstadoRepublica ? 'selected' : ''}}>{{$state->nombre}}</option>
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
                        <option value="{{old('cultura', $cult->idCultura)}}">{{$cult->nombre}}</option>
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
            <legend>Ubicación</legend>
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
            mexico = { lat: 23.6345, lng: -102.5528 };
            geocoder = new google.maps.Geocoder();

            map = new google.maps.Map(
                document.getElementById('map'), {
                    zoom: 6,
                    center: mexico,
                    mapTypeControl: true,
                    scrollwheel: false,
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
                                "color": "#242f3e"
                            }
                            ]
                        },
                        {
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#746855"
                            }
                            ]
                        },
                        {
                            "elementType": "labels.text.stroke",
                            "stylers": [
                            {
                                "color": "#242f3e"
                            }
                            ]
                        },
                        {
                            "featureType": "administrative.locality",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#d59563"
                            }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#d59563"
                            }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#263c3f"
                            }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#6b9a76"
                            }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#38414e"
                            }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "geometry.stroke",
                            "stylers": [
                            {
                                "color": "#212a37"
                            }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#9ca5b3"
                            }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#746855"
                            }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "geometry.stroke",
                            "stylers": [
                            {
                                "color": "#1f2835"
                            }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#f3d19c"
                            }
                            ]
                        },
                        {
                            "featureType": "transit",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#2f3948"
                            }
                            ]
                        },
                        {
                            "featureType": "transit.station",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#d59563"
                            }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "geometry",
                            "stylers": [
                            {
                                "color": "#17263c"
                            }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "labels.text.fill",
                            "stylers": [
                            {
                                "color": "#515c6d"
                            }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "labels.text.stroke",
                            "stylers": [
                            {
                                "color": "#17263c"
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
                const latLng = marker.getPosition();
                updateInputs(latLng);
                getAddressFromCoordinates(latLng);
            });

            const input = document.getElementById("direccion");
            const autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.bindTo("bounds", map);

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
            <div class="info-content">Latitud: ${lat}<br>Longitud: ${lng}</div>
        `;
                        positionInfoBox(latLng);
                    } else {
                        window.alert("No se encontraron resultados.");
                    }
                } else {
                    window.alert("Error en Geocoder: " + status);
                }
            });
        }
        function positionInfoBox(latlng) {
    const projection = map.getProjection();
    const point = projection.fromLatLngToPoint(latlng);
    // const scale = Math.pow(2, map.getZoom());
    // const pixelCoordinates = new google.maps.Point(
    //     point.x * scale,
    //     point.y * scale
    // );

    // Obtener las dimensiones del cuadro de información
    const infoBoxWidth = infoBox.offsetWidth;
    const infoBoxHeight = infoBox.offsetHeight;

    // Calcular la posición final del cuadro de información
    const mapDiv = document.getElementById('map'); // Asegúrate de que 'map' sea el ID correcto
    const mapOffset = mapDiv.getBoundingClientRect();

    // Ajustar la posición relativa al mapa
    infoBox.style.left = pixelCoordinates.x + 'px';
    infoBox.style.top = (pixelCoordinates.y - infoBoxHeight) + 'px'; // Coloca el cuadro por encima del marcador

    // Asegurarte de que el cuadro de información no se salga de la pantalla
    const infoBoxRect = infoBox.getBoundingClientRect();
    if (infoBoxRect.right > window.innerWidth) {
        infoBox.style.left = (window.innerWidth - infoBoxWidth) + 'px';
    }
    if (infoBoxRect.bottom > window.innerHeight) {
        infoBox.style.top = (window.innerHeight - infoBoxHeight) + 'px';
    }

    // Considera el desplazamiento del mapa
    const scrollY = window.scrollY || document.documentElement.scrollTop;
    infoBox.style.top = (parseInt(infoBox.style.top) + scrollY) + 'px';
}



    </script>
@endsection
