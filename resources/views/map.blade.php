@extends('layout.app')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin="" />
    <link rel="stylesheet" href="{{ asset('leafletjs/MarkerCluster.Default.css')}}" />
    <link rel="stylesheet" href="{{ asset('leafletjs/leaflet.groupedlayercontrol.css')}}" />
    <link rel="stylesheet" href="{{ asset('leafletjs/leaflet-search.css')}}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />

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

                            <div class="main-body">
                                <div class="page-wrapper">
                                    <!-- Page-header start -->
                                    <div class="page-header m-t-30">

                                    </div>
                                    <!-- Page-header end -->
                                    <!-- Page body start -->
                                    <div class="page-body">
                                        <div class="row">

                                            <div class="col-lg-12">
                                                <!-- Default card start -->
                                                  <!-- Zero config.table start -->
                                                <div class="card">
                                                    <div class="card-header">

                                                    </div>
                                                    <div class="card-block" style="margin-top: -30px;">
                                                        <div id="map"></div>
                                                    </div>
                                                </div>
                                            <!-- Zero config.table end -->
                                            <!-- Default ordering table start -->
                                                <!-- Default card end -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Page body end -->
                                </div>
                            </div>
@endsection

@push('scripts')

    <script src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""></script>
        <script src="{{ asset('leafletjs/leaflet.markercluster.js')}}"></script>
        <script src="{{ asset('leafletjs/leaflet.groupedlayercontrol.js')}}"></script>
        <script src="{{ asset('leafletjs/leaflet-search.js')}}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>


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

        var map = L.map('map', {
            center: [{{ $centrePoint->location }}],
            zoom: 5,
            layers: [streets]
        });
        var baseLayers = {
            "Grayscale": dark,
            "Satellite": satellite,
            "Streets": streets
        };
        var overlays = {
            "Streets": streets,
            "Grayscale": dark,
            "Satellite": satellite,
        };
        var myIcon = L.icon({
            iconUrl: "{{ asset('pesawat.png')}}",
            iconSize: [16, 16]
        });

        var layerControl = L.control.groupedLayers(baseLayers).addTo(map);

        //L.control.Measure().addTo(map);
        //var zooms = L.control.zoom({position:'topright'}).addTo(map);
        var drawnItems = new L.FeatureGroup();
        map.addLayer(drawnItems);
        var drawControl = new L.Control.Draw({
            edit: {
                featureGroup: drawnItems
            }
        });
        map.addControl(drawControl);

        map.on(L.Draw.Event.CREATED, function (e) {
            var type = e.layerType,
                layer = e.layer;
            if (type === 'marker') {
                // Do marker specific actions
            }
            // Do whatever else you need to. (save to db; add to map etc)
            map.addLayer(layer);
            });



        // var groupedOverlays = {
        //     "Landmarks": {
        //         "Motorways": motorways,
        //         "Cities": cities
        //     },
        //     "Points of Interest": {
        //         "Restaurants": restaurants
        //     }
        //     };

        //     L.control.groupedLayers(baseLayers, groupedOverlays).addTo(map);



        // Menampilkan popup data ketika marker di klik
        // var markers = L.markerClusterGroup();

        // @foreach ($airbases as $item)
        //     markers.addLayer(L.marker([{{ $item->location }}], {icon: myIcon})
        //         .bindPopup(
        //             "<div class='my-2'><img src='{{ asset('/uploads/imgCover/' . $item->image) }}' class='img-fluid' width='700px'></div>" +
        //             "<div class='my-2'><strong>Nama airbase:</strong> <br>{{ $item->name_airbase }}</div>" +
        //             "<div><a href='{{ route('map.show', $item->slug) }}' class='btn btn-outline-info btn-sm'>Detail airbase</a></div>" +
        //             "<div class='my-2'></div>"
        //         ));
        // @endforeach

        // map.addLayer(markers);


        // pada koding ini kita menambahkan control pencarian data
        var markersLayer = new L.markerClusterGroup();

        map.addLayer(markersLayer);

        var controlSearch = new L.Control.Search({
            position:'topright',
            layer: markersLayer,
            initial: false,
            zoom: 17,
            markerLocation: true
        });

        map.addControl( controlSearch );


         var datas = [
        @foreach ($airbases as $key => $value)
            {   "loc":[{{$value->location }}],
                "title": '{!! $value->name_airbase !!}',
                "slug": '{!! $value->slug !!}',
                "image": '{!! $value->image !!}',
            },

        @endforeach
        ];

        //////////populate map with markers from sample data
        for(i in datas) {
            var title = datas[i].title,	//value searched
                loc = datas[i].loc,
                slug = datas[i].slug,
                image = datas[i].image,
                	//position found

                marker = new L.Marker(new L.latLng(loc), {title:title, icon: myIcon} );//se property searched
                marker.bindPopup(
                    "<div class='my-2'><img src='{{ asset('/uploads/imgCover/') }}/"+image + "' class='img-fluid' width='700px'></div>" +
                    "<div class='my-2'><strong>Nama airbase:</strong> <br>"+ title + " - "+ slug +"</div>" +
                    "<a href='map/"+slug+"' class='btn btn-outline-info btn-sm'>Detail Spot</a></div>" +
                    "<div class='my-2'></div>"
                );

                markersLayer.addLayer(marker);
        }





        // var datas = [
        // @foreach ($airbases as $key => $value)
        //     {"loc":[{{$value->location }}], "title": '{!! $value->name_airbase !!}'},
        // @endforeach
        // ];

    // //menambahkan variabel controlsearch pada addControl
    //    map.addControl( controlSearch );
    //     // looping variabel datas utuk menampilkan data airbase ketika melakukan pencarian data
    //     for(i in datas) {

    //         var title = datas[i].title,
    //             loc = datas[i].loc,
    //             marker = new L.Marker(new L.latLng(loc), {title: title} );
    //         markersLayer.addLayer(marker);
    //         // melakukan looping data untuk memunculkan popup dari airbase yang dipilih
    //         @foreach ($airbases as $item)
    //         L.marker([{{ $item->location }}]
    //             )
    //             .bindPopup(
    //                 "<div class='my-2'><img src='{{ asset('/uploads/imgCover/' . $item->image) }}' class='img-fluid' width='700px'></div>" +
    //                 "<div class='my-2'><strong>Nama Spot:</strong> <br>{{ $item->name_airbase }}</div>" +
    //                 "<a href='{{ route('map.show', $item->slug) }}' class='btn btn-outline-info btn-sm'>Detail Spot</a></div>" +
    //                 "<div class='my-2'></div>"
    //             ).addTo(map);
    //         @endforeach
    //     }



        //L.control.layers(baseLayers, overlays).addTo(map);

       //document.getElementById("span_pilih_1").onclick = function() {alert('ooook')};
       function spanpilih($id){
            var title = '1',	//value searched
                loc = $id,
                	//position found

                marker = new L.Marker(new L.latLng(loc), {title:title, icon: myIcon} );//se property searched

                markersLayer.addLayer(marker);
        }
    </script>


@endpush
