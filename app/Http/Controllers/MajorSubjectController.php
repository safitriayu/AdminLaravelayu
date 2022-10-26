<?php

namespace App\Http\Controllers;
use App\Models\MajorSubject;

use Illuminate\Http\Request;

class MajorSubjectController extends Controller
{
    public function index()
    {
        try {
            $data_subject = MajorSubject::all();
            return view('admin.major.index', [
                'data' => $data_subject
            ]);
            // dd($data);
        } catch (\Throwable $th) {
            // dd($th);
        }
    }

    public function create()
    {
        try {
            return view('admin.major.create');
        } catch (\Throwable $th) {
            return redirect('/majors')->with('toast_error',  'Halaman tidak dapat di akses!');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            MajorSubject::create([
                'name' => $request->name,
            ]);
            return redirect('/majors')->with('toast_success', 'Data berhasil ditambah!');
        } catch (\Throwable $th) {
            dd($th);
            // return redirect('/Majors')->with('toast_error',  'Data tidak berhasil ditambah!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data = MajorSubject::find($id);
            return view('admin.major.edit', [
                'data' => $data
            ]);
        } catch (\Throwable $th) {
            return redirect('/majors')->with('toast_error',  'Halaman tidak dapat di akses!');
        }
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
        try {
            MajorSubject::where("id", $id)->update([
                'name' => $request->name,
            ]);
            return redirect('/majors')->with('toast_success', 'Data berhasil diubah!');
        } catch (\Throwable $th) {
            return redirect('/majors')->with('toast_error',  'Data tidak berhasil diubah!');
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
        try {
            MajorSubject::where('id', $id)->delete();
            return redirect('/majors')->with('toast_success', 'Data berhasil dihapus!');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

}
