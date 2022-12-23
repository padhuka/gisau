<?php

namespace App\Http\Controllers;

use App\Models\Airbase;
use App\Models\CentrePoint;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;


class AirbaseController extends Controller
{
    public function airbases()
    {
        // Method ini untuk menampilkan data dari tabel airbases
        // ke dalam datatables kita juga menambahkan column untuk menampilkan button
        // action
        $airbases = Airbase::select('airbases.*','countries.name_country')
                        ->join('countries','airbases.country_id','=','countries.id')
                        ->orderBy('airbases.name_airbase','ASC');
        return datatables()->of($airbases)
        ->addColumn('action','airbase.action')
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
        return view('airbase.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::orderby('name_country','ASC')->get();
        $centrepoint = CentrePoint::get()->first();
        return view('airbase.create', [
            'centrepoint' => $centrepoint,
            'countries' => $countries
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
            'country' => 'required',
            'code' => 'required',
            'name' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg',
            'location' => 'required'
        ]);

        // melakukan pengecekan ketika ada file gambar yang akan di input
        $airbase = new Airbase();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $uploadFile = time() . '_' . $file->getClientOriginalName();
            $file->move('uploads/imgCover/', $uploadFile);
            $airbase->image = $uploadFile;
        }

        // jalankan proses simpan data ke table centrepoint
        //$airbase = new Airbase();
        $airbase->code_airbase = $request->input('code');
        $airbase->name_airbase = $request->input('name');
        $airbase->country_id = $request->input('country');
        $airbase->slug = $request->input('code');//Str::slug($this->name_country,'-');
        $airbase->location = $request->input('location');
        $airbase->description = $request->input('description');
        $airbase->save();

        // setelah data disimpan redirect ke halaman index centrepoint
        if ($airbase) {
            return redirect()->route('airbase.index')->with('success', 'Data berhasil Disimpan');
        } else {
            return redirect()->route('airbase.index')->with('error', 'Data gagal Disimpan');
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
    public function edit(Airbase $airbase)
    {
        $countries = Country::orderby('name_country','ASC')->get();
        $airbase = Airbase::findOrFail($airbase->id);
        return view('airbase.edit',[
            'airbase' => $airbase,
            'countries' => $countries
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Airbase $airbase)
    {

        $this->validate($request,[
            'country' => 'required',
            'code' => 'required',
            'name' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg',
            'location' => 'required'
        ]);

        $airbase = Airbase::findOrFail($airbase->id);
        if ($request->hasFile('image')) {

            if (File::exists("uploads/imgCover/" . $airbase->image)) {
                File::delete("uploads/imgCover/" . $airbase->image);
            }

            $file = $request->file("image");
            //$uploadFile = StoreImage::replace($airbase->image,$file->getRealPath(),$file->getClientOriginalName());
            $uploadFile = time() . '_' . $file->getClientOriginalName();
            $file->move('uploads/imgCover/', $uploadFile);
            $airbase->image = $uploadFile;
        }

        $airbase->code_airbase = $request->input('code');
        $airbase->name_airbase = $request->input('name');
        $airbase->country_id = $request->input('country');
        $airbase->slug = $request->input('name');//Str::slug($this->name_country,'-');
        $airbase->location = $request->input('location');
        $airbase->description = $request->input('description');
        $airbase->update();

        if ($airbase) {
            return redirect()->route('airbase.index')->with('success', 'Data berhasil Diupdate');
        } else {
            return redirect()->route('airbase.index')->with('error', 'Data gagal Diupdate');
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
        $airbase = Airbase::findOrFail($id);
        $airbase->delete();
        return redirect()->back();
    }
}