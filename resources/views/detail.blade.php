@extends('layout.app')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />

        <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }
        .leaflet-container {
            height: 400px;
            width: 600px;
            max-width: 100%;
            max-height: 100%;
        }
            body {
                padding: 0;
                margin: 0;
            }
            #map {
                height: 600px;
                width: 100%;
            }
    </style>

@endpush

@section('content')
    <div class="container py-4 justify-content-center">
        <div class="row">
            <div class="col-md-6 col-xs-6 mb-2">
                <div class="card">
                    <div class="card-body">
                        <p>
                        <h5><strong>Nama Skuadron :</strong></h5>
                        <h5>{{ $airbases->name_airbase }}</h5>
                        </p>

                        <p>
                        <h5><strong>Keterangan Skuadron :</strong></h5>
                        <p>{{ $airbases->description }}</p>
                        </p>

                        <p>
                        <h5>
                            <strong>Foto</strong>
                        </h5>
                        <img class="img-fluid" width="200" src="{{ asset('uploads/imgCover/' . $airbases->image) }}"
                            alt="">
                        </p>

                        <p>
                        <h5><strong>Pesawat di Skuadron :</strong></h5>
                        <p>
                            @foreach ($planeairbases as $planeairbase)
                                <strong>- &nbsp;{{$planeairbase->code_plane}}</br></strong>
                            @endforeach
                        </p>
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('map.index') }}" class="btn btn-outline-primary">Kembali</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xs-6">
                <div class="card">
                    <div class="card-body">
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>

    <script>
        var mbAttr = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            mbUrl =
            'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw';
        var satellite = L.tileLayer(mbUrl, {
                id: 'mapbox/satellite-v9',
                tileSize: 512,
                zoomOffset: -1,
                attribution: mbAttr
            }),
            dark = L.tileLayer(mbUrl, {
                id: 'mapbox/dark-v10',
                tileSize: 512,
                zoomOffset: -1,
                attribution: mbAttr
            }),
            streets = L.tileLayer(mbUrl, {
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1,
                attribution: mbAttr
            });
        var data{{ $airbases->id }} = L.layerGroup()

        var map = L.map('map', {
            center: [{{ $airbases->location }}],
            zoom: 20,
            fullscreenControl: {
                pseudoFullscreen: false
            },
            layers: [streets, data{{ $airbases->id }}],
        });

        var baseLayers = {
            "Streets": streets,
            "Satellite": satellite,
            "Dark": dark,
        };
        var overlays = {
            //"Streets": streets
            "{{ $airbases->name }}": data{{ $airbases->id }},
        };
        L.control.layers(baseLayers, overlays).addTo(map);

        var myIcon = L.icon({
            iconUrl: "{{ asset('pesawat.png')}}",
            iconSize: [16, 16]
        });

        var curLocation = [{{ $airbases->location }}];
        map.attributionControl.setPrefix(false);
        var marker = new L.marker(curLocation, {
            draggable: 'false',
            icon: myIcon
        });
        map.addLayer(marker);
    </script>


@endpush
