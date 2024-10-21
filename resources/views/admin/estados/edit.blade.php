@extends('layouts.main-admin')

@section('src-maps')
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIpIISAV4iA4HQYpwSDnBpgVe2iQFKYig&loading=async&libraries=places&callback=initMap"></script>
    <script type="module" src="https://unpkg.com/@googlemaps/extended-component-library@0.6"></script>
@endsection

@section('titulo', 'Editar estado | INAH')

@section('admin-content')
    <form action="{{route('admin.estados.update', $state)}}" method="POST" enctype="multipart/form-data" onload="initMap()">
        @csrf
        @method('put')

        <h2>Editar estado</h2>
        <fieldset>
            <legend>Nombre</legend>
            <input type="hidden" name="name" id="name" value="{{$state->nombre}}">
            <input type="text" name="nombre" id="nombre" value="{{old('nombre', $state->nombre)}}">
            @error('nombre')
                <div>{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Capital</legend>
            <input type="text" name="capital" id="" value="{{old('capital', $state->capital)}}">
            @error('capital')
                <div>{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Foto</legend>
            <input type="file" name="foto" id="foto" accept="image/*">
            <div>
                <img src="{{img_u_url($state->foto)}}" width="300px" alt="estado">
            </div>
            @error('foto')
                <div>{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Video (Ingresa la URL del video)</legend>
            <input type="text" name="video" id="" value="{{old('video', $state->video)}}">
            @error('video')
                <div>{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Triptico</legend>
            <input type="file" name="triptico">
            <input type="text" name="" id="" value="{{old('triptico', basename(triptico_url($state->triptico)))}}" disabled>
            @error('triptico')
                <div>{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <legend>Guia</legend>
            <input type="file" name="guia">
            <input type="text" name="" id="" value="{{old('guia', basename(guia_url($state->guia)))}}" disabled>
            @error('guia')
                <div>{{$message}}</div>
            @enderror
        </fieldset>

        <fieldset>
            <div id="info-box"></div>
            <div id="map" style="width: 100%; height: 500px;"> </div>
        </fieldset>

        <button type="submit">Guardar</button>
    </form>
@endsection


@section('js')
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

            geocoder = new google.maps.Geocoder();

            let location = document.getElementById('name').value;
            geocoder.geocode({ address: location }, function (results, status) {
                if (status === "OK") {
                    const estado = results[0].geometry.location;

                    map = new google.maps.Map(
                        document.getElementById('map'), {
                            zoom: 6,
                            center: estado,
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
                        position: estado,
                        map: map,
                        draggable: false,
                    });

                    infoBox = document.getElementById("info-box");
                    getAddressFromCoordinates(marker.getPosition());
                } else {
                    console.error("Geocoding fallido debido a: " + status);
                }
            });
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
