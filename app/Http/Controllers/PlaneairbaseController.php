<?php

namespace App\Http\Controllers;

use App\Models\Planeairbase;
use Illuminate\Http\Request;

class PlaneairbaseController extends Controller
{
    public function planeairbases()
    {
        // Method ini untuk menampilkan data dari tabel planeairbases
        // ke dalam datatables kita juga menambahkan column untuk menampilkan button
        // action
        $planeairbases = Planeairbase::select('planeairbases.*','planes.name_plane','airbases.name_airbase','countries.name_country')
                        ->join('planes','planeairbases.plane_id','=','planes.id')
                        ->join('airbases','planeairbases.airbase_id','=','airbases.id')
                        ->join('countries','airbases.country_id','=','countries.id')
                        ->orderBy('airbases.name_airbase','ASC');
        return datatables()->of($planeairbases)
        ->addColumn('action','planeairbase.action')
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->toJson();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('planeairbase.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
