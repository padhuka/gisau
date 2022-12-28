<?php

namespace App\Http\Controllers;

use App\Models\Airbase;
use App\Models\Plane;
use App\Models\Planeairbase;
use Illuminate\Http\Request;

class PlaneairbaseController extends Controller
{
    public function planeairbases()
    {
        // Method ini untuk menampilkan data dari tabel planeairbases
        // ke dalam datatables kita juga menambahkan column untuk menampilkan button
        // action
        $planeairbases = Planeairbase::select('planeairbases.*','planes.code_plane','airbases.name_airbase','countries.name_country')
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
        $airbases = Airbase::orderby('name_airbase','ASC')->get();
        $planes = Plane::orderby('name_plane','ASC')->get();
        return view('planeairbase.create', [
            'airbases' => $airbases,
            'planes' => $planes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Lakukan validasi data
        $this->validate($request,[
            'airbase' => 'required',
            'plane' => 'required',
        ]);

        // melakukan pengecekan ketika ada file gambar yang akan di input
        $planeairbase = new Planeairbase();
        $planeairbase->airbase_id = $request->input('airbase');
        $planeairbase->plane_id = $request->input('plane');
        $planeairbase->description = $request->input('description');
        $planeairbase->save();

        // setelah data disimpan redirect ke halaman index centrepoint
        if ($planeairbase) {
            return redirect()->route('planeairbase.index')->with('success', 'Data berhasil Disimpan');
        } else {
            return redirect()->route('planeairbase.index')->with('error', 'Data gagal Disimpan');
        }
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
    public function edit(Planeairbase $planeairbase)
    {
        $airbases = Airbase::orderby('name_airbase','ASC')->get();
        $planes = Plane::orderby('name_plane','ASC')->get();
        $planeairbase = Planeairbase::findOrFail($planeairbase->id);
        return view('planeairbase.edit',[
            'airbases' => $airbases,
            'planes' => $planes,
            'planeairbase' => $planeairbase,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, Planeairbase $planeairbase)
    {
        $this->validate($request,[
            'airbase' => 'required',
            'plane' => 'required',
        ]);

        $planeairbase = Planeairbase::findOrFail($planeairbase->id);

        $planeairbase->airbase_id = $request->input('airbase');
        $planeairbase->plane_id = $request->input('plane');
        $planeairbase->description = $request->input('description');
        $planeairbase->update();

        if ($planeairbase) {
            return redirect()->route('planeairbase.index')->with('success', 'Data berhasil Diupdate');
        } else {
            return redirect()->route('planeairbase.index')->with('error', 'Data gagal Diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plane = Planeairbase::findOrFail($id);
        $plane->delete();
        return redirect()->back();
    }
}
