@extends('layout.app')

@push('styles')
    <link
      rel="stylesheet"
      href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
      integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
      crossorigin=""
    />
    <link rel="stylesheet" href="{{ asset('leafletjs/MarkerCluster.Default.css')}}" />
    <link rel="stylesheet" href="{{ asset('leafletjs/leaflet.groupedlayercontrol.css')}}" />
    <link rel="stylesheet" href="{{ asset('leafletjs/leaflet-search.css')}}" />
    <link rel="stylesheet" href="{{ asset('Leaflet.draw-develop/src/leaflet.draw.css')}}" />

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

    <script
    src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
    crossorigin=""
    ></script>
        <script src="{{ asset('leafletjs/leaflet.markercluster.js')}}"></script>
        <script src="{{ asset('leafletjs/leaflet.groupedlayercontrol.js')}}"></script>
        <script src="{{ asset('leafletjs/leaflet-search.js')}}"></script>
        <script src="{{ asset('Leaflet.draw-develop/src/Leaflet.draw.js')}}"></script>
        <script src="{{ asset('Leaflet.draw-develop/src/Leaflet.Draw.Event.js')}}"></script>

        <script src="{{ asset('Leaflet.draw-develop/src/Toolbar.js')}}"></script>
        <script src="{{ asset('Leaflet.draw-develop/src/Tooltip.js')}}"></script>

        <script src="{{ asset('Leaflet.draw-develop/src/ext/GeometryUtil.js')}}"></script>
        <script src="{{ asset('Leaflet.draw-develop/src/ext/LatLngUtil.js')}}"></script>
        <script src="{{ asset('Leaflet.draw-develop/src/ext/LineUtil.Intersect.js')}}"></script>
        <script src="{{ asset('Leaflet.draw-develop/src/ext/Polygon.Intersect.js')}}"></script>
        <script src="{{ asset('Leaflet.draw-develop/src/ext/Polyline.Intersect.js')}}"></script>
        <script src="{{ asset('Leaflet.draw-develop/src/ext/TouchEvents.js')}}"></script>

        <script src="{{ asset('Leaflet.draw-develop/src/draw/DrawToolbar.js')}}"></script>
        <script src="{{ asset('Leaflet.draw-develop/src/draw/handler/Draw.Feature.js')}}"></script>
        <script src="{{ asset('Leaflet.draw-develop/src/draw/handler/Draw.SimpleShape.js')}}"></script>
        <script src="{{ asset('Leaflet.draw-develop/src/draw/handler/Draw.Polyline.js')}}"></script>
        <script src="{{ asset('Leaflet.draw-develop/src/draw/handler/Draw.Marker.js')}}"></script>
        <script src="{{ asset('Leaflet.draw-develop/src/draw/handler/Draw.Circle.js')}}"></script>
        <script src="{{ asset('Leaflet.draw-develop/src/draw/handler/Draw.CircleMarker.js')}}"></script>
        <script src="{{ asset('Leaflet.draw-develop/src/draw/handler/Draw.Polygon.js')}}"></script>
        <script src="{{ asset('Leaflet.draw-develop/src/draw/handler/Draw.Rectangle.js')}}"></script>


        <script src="{{ asset('Leaflet.draw-develop/src/edit/EditToolbar.js')}}"></script>
        <script src="{{ asset('Leaflet.draw-develop/src/edit/handler/EditToolbar.Edit.js')}}"></script>
        <script src="{{ asset('Leaflet.draw-develop/src/edit/handler/EditToolbar.Delete.js')}}"></script>

        <script src="{{ asset('Leaflet.draw-develop/src/Control.Draw.js')}}"></script>

        <script src="{{ asset('Leaflet.draw-develop/src/edit/handler/Edit.Poly.js')}}"></script>
        <script src="{{ asset('Leaflet.draw-develop/src/edit/handler/Edit.SimpleShape.js')}}"></script>
        <script src="{{ asset('Leaflet.draw-develop/src/edit/handler/Edit.Rectangle.js')}}"></script>
        <script src="{{ asset('Leaflet.draw-develop/src/edit/handler/Edit.Marker.js')}}"></script>
        <script src="{{ asset('Leaflet.draw-develop/src/edit/handler/Edit.CircleMarker.js')}}"></script>
        <script src="{{ asset('Leaflet.draw-develop/src/edit/handler/Edit.Circle.js')}}"></script>


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

        var myIcon = L.icon({
            iconUrl: "{{ asset('pesawat.png')}}",
            iconSize: [16, 16]
        });

        // pada koding ini kita menambahkan control pencarian data
        var markersLayer = new L.markerClusterGroup();

        map.addLayer(markersLayer);

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
                    "<div class='my-2'><img src='{{ asset('/uploads/imgCover/') }}/"+image + "' class='img-fluid' width='200px' height='200px'></div>" +
                    "<div class='my-2'><strong>Nama airbase:</strong> <br>"+ title + "</div>" +
                    "<a href='map/"+slug+"' class='btn btn-outline-info btn-sm'>Detail Info</a></div>" +
                    "<div class='my-2'></div>"
                );

                markersLayer.addLayer(marker);
        }

        var baseLayers = {
            "Streets": streets,
            "Satellite": satellite,
            "Grayscale": dark
        };

        var overlays = {
            "Skuadron": markersLayer,
        };

        var drawnItems = L.featureGroup().addTo(map);


        //var layerControl = L.control.groupedLayers(baseLayers).addTo(map);
        var layerControl = L.control.layers(baseLayers,overlays, {collapsed:false}).addTo(map);

        var controlSearch = new L.Control.Search({
            position:'topleft',
            layer: markersLayer,
            initial: false,
            zoom: 17,
            markerLocation: true,
            collapsed: false
        });

        map.addControl( controlSearch );

        map.addControl(new L.Control.Draw({
            edit: {
                featureGroup: drawnItems,
                poly: {
                    allowIntersection: false
                }
            },
            draw: {
                polygon: {
                    allowIntersection: false,
                    showArea: true
                }
            }
        }));

        map.on(L.Draw.Event.CREATED, function (event) {
            var layer = event.layer;

            drawnItems.addLayer(layer);

            var type = event.layerType,
                layer = event.layer;
                if (type = 'polyline') {
                    var coords = layer.getLatLngs();
                    var length = 0;
                    for (var i = 0; i < coords.length - 1; i++) {
                        length += coords[i].distanceTo(coords[i + 1]);
                    }
                    //console.log(length);
                    var angka = length/1000;
                    layer.bindPopup("Jarak "+  angka.toFixed(2) + " km");
                }
        });



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
