<?php

namespace App\Http\Controllers;

use App\Models\Plane;
use Illuminate\Http\Request;

class PlaneController extends Controller
{
    public function planes()
    {
        // Method ini untuk menampilkan data dari tabel planes
        // ke dalam datatables kita juga menambahkan column untuk menampilkan button
        // action
        $planes = Plane::orderBy('name_plane','ASC');
        return datatables()->of($planes)
        ->addColumn('action','plane.action')
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
        return view('plane.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('plane.create');
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
            'name' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg',
        ]);

        // melakukan pengecekan ketika ada file gambar yang akan di input
        $plane = new Plane();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $uploadFile = time() . '_' . $file->getClientOriginalName();
            $file->move('uploads/imgCover/', $uploadFile);
            $plane->image = $uploadFile;
        }

        // jalankan proses simpan data ke table centrepoint
        //$plane = new plane();
        $plane->code_plane = $request->input('code');
        $plane->name_plane = $request->input('name');
        $plane->slug = $request->input('code');//Str::slug($this->name_country,'-');
        $plane->description = $request->input('description');
        $plane->save();

        // setelah data disimpan redirect ke halaman index centrepoint
        if ($plane) {
            return redirect()->route('plane.index')->with('success', 'Data berhasil Disimpan');
        } else {
            return redirect()->route('plane.index')->with('error', 'Data gagal Disimpan');
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
    public function edit(Plane $plane)
    {
        $plane = Plane::findOrFail($plane->id);
        return view('plane.edit',[
            'plane' => $plane
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plane $plane)
    {

        $this->validate($request,[
            'code' => 'required',
            'name' => 'required',
            'image' => 'image|mimes:png,jpg,jpeg',
        ]);

        $plane = Plane::findOrFail($plane->id);
        if ($request->hasFile('image')) {

            if (File::exists("uploads/imgCover/" . $plane->image)) {
                File::delete("uploads/imgCover/" . $plane->image);
            }

            $file = $request->file("image");
            //$uploadFile = StoreImage::replace($plane->image,$file->getRealPath(),$file->getClientOriginalName());
            $uploadFile = time() . '_' . $file->getClientOriginalName();
            $file->move('uploads/imgCover/', $uploadFile);
            $plane->image = $uploadFile;
        }

        $plane->code_plane = $request->input('code');
        $plane->name_plane = $request->input('name');
        $plane->slug = $request->input('name');//Str::slug($this->name_country,'-');
        $plane->description = $request->input('description');
        $plane->update();

        if ($plane) {
            return redirect()->route('plane.index')->with('success', 'Data berhasil Diupdate');
        } else {
            return redirect()->route('plane.index')->with('error', 'Data gagal Diupdate');
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
        $plane = Plane::findOrFail($id);
        $plane->delete();
        return redirect()->back();
    }
}
