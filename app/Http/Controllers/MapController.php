<?php

namespace App\Http\Controllers;

use App\Models\CentrePoint;
use App\Models\Airbase;
use App\Models\Planeairbase;
use Illuminate\Http\Request;

class MapController extends Controller
{
/**
         *  Pada method index kita mengambil single data dari tabel centrepoint
         *  Selanjutnya kita mengambil seluruh data dari tabel airbase untuk menampilkan marker yang akan
         *  kita gtampilkan pada view map.blade
         */

    public function index()
    {
        /**
         *  Pada method index kita mengambil single data dari tabel centrepoint
         *  Selanjutnya kita mengambil seluruh data dari tabel airbase untuk menampilkan marker yang akan
         *  kita gtampilkan pada view map.blade
         */
        $centrePoint = CentrePoint::get()->first();
        $airbases = Airbase::get();
        return view('map',[
            'airbases' => $airbases,
            'centrePoint' => $centrePoint
        ]);
        //return dd($airbases);
    }

    public function show($slug)
    {
        /**
         * Hampir sama dengam method index diatas
         * tapi disini kita hanya akan menampilkan single data saja untuk airbase
         * yang kita pilih pada view map dan selanjutnya kita akan di arahkan
         * ke halaman detail untuk melihat informasi lebih lengkap dari airbase
         * yang kita pilih
         */
        $centrePoint = CentrePoint::get()->first();
        $airbases = Airbase::where('slug',$slug)->first();
        $planeairbases = Planeairbase::select('planeairbases.*','planes.code_plane','airbases.name_airbase','countries.name_country')
                        ->join('planes','planeairbases.plane_id','=','planes.id')
                        ->join('airbases','planeairbases.airbase_id','=','airbases.id')
                        ->join('countries','airbases.country_id','=','countries.id')
                        ->orderBy('airbases.name_airbase','ASC')
                        ->get();
        return view('detail',[
            'centrePoint' => $centrePoint,
            'airbases' => $airbases,
            'planeairbases' => $planeairbases
        ]);



    }
}
