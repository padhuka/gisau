<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CountryController extends Controller
{

    public function countries()
    {
        // Method ini untuk menampilkan data dari tabel spaces
        // ke dalam datatables kita juga menambahkan column untuk menampilkan button
        // action
        $countries = Country::orderBy('name_country','ASC');
        return datatables()->of($countries)
        ->addColumn('action','country.action')
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
        return view('country.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('country.create');
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
            'code' => 'required',
            'name' => 'required'
        ]);

        // jalankan proses simpan data ke table centrepoint
        $country = new Country();
        $country->code_country = $request->input('code');
        $country->name_country = $request->input('name');
        $country->slug = $request->input('name');//Str::slug($this->name_country,'-');
        $country->save();

        // setelah data disimpan redirect ke halaman index centrepoint
        if ($country) {
            return redirect()->route('country.index')->with('success', 'Data berhasil Disimpan');
        } else {
            return redirect()->route('country.index')->with('error', 'Data gagal Disimpan');
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
    public function edit(Country $country)
    {
        // Mencari data yang dipilih lalu menampilkannya ke view edit centrepoint
        // dan mempassing $centrePoint ke view edit centrepoint
        $country = Country::findOrFail($country->id);
        return view('country.edit',[
            'country' => $country
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        // setelah data centrepoint yang akan di edit sesuai
        // maka jalankan proses update jika berhasil akan di redirect ke halaman index
        $country = Country::findOrFail($country->id);
        $country->code_country = $request->input('code');
        $country->name_country = $request->input('name');
        $country->slug = Str::slug($request->name, '-');
        $country->update();

        if ($country) {
            return redirect()->route('country.index')->with('success', 'Data berhasil Diupdate');
        } else {
            return redirect()->route('country.index')->with('error', 'Data gagal Diupdate');
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
        // Proses hapus data  dari tabel centrepoint
        $country = Country::findOrFail($id);
        $country->delete();
        return redirect()->back();
    }
}
